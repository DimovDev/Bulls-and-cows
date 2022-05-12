<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use stdClass;

class GameController extends Controller
{
    /**
     * Start new game
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function newGame(Request $request)
    {
        $name = $request->input('name') ? $request->input('name') : session('name');

        if (!$name) {
            return response("Please enter your name!", 400);
        }
        session(['name' => $name]);
        session()->forget(['tries', 'generatedNumber', 'time']);

        $this->generateNumber();

        return response()->json(['success' => 'The name have been submitted successfully', 'name' => $name]);
    }

    /**
     * Generate random 4 numbers string
     *
     * @return void
     */
    private function generateNumber()
    {
        $generated = implode(array_rand(array_flip(range(0, 9)), 4));

        $generatedNumber = $this->customLimitation($generated);

        session(['generatedNumber' => $generatedNumber, 'tries' => 0]);
    }

    /**
     * Check guess
     *
     * @param $guess
     *
     * @return Application|ResponseFactory|Response
     */
    public function checkNumber($guess)
    {
        $generatedNumber = session('generatedNumber');

        if (!is_numeric($guess) || strlen($guess) < 4 || count(array_unique(str_split($guess))) !== 4) {
            return response('Invalid number!', 400);
        }

        session()->increment('tries');

        $bulls = 0;
        $cows = 0;
        if ($guess == $generatedNumber) {
            $record = new stdClass();
            $record->name = session('name');
            $record->tries = session('tries');
            if ($_GET['time']) {
                $record->time = $_GET['time'];
            }
            $this->addTop10($record);

            return response(['win' => true, 'tries' => session('tries'), 'time' => $_GET['time']]);
        } else {
            foreach (range(0, 3) as $i) {
                if ($guess[$i] == $generatedNumber[$i]) {
                    $bulls++;
                } else if (strpos($generatedNumber, $guess[$i]) !== FALSE) {
                    $cows++;
                }
            }
        }
        return response(['bulls' => $bulls, 'cows' => $cows, 'tries' => session('tries')]);
    }

    /*
     * Give Up
     *
     * @return string
     */
    public function giveUp()
    {
        $number = session('generatedNumber');
        session()->forget(['generatedNumber', 'tries']);
        return $number;
    }

    /*
     * Add player to top 10
     *
     * @param $current
     *
     * @return void
     */
    private function addTop10($current)
    {
        if ($current->tries) {
            $this->generateTop10('top-tries.json', 'tries', 'time', $current);
        }
        if ($current->time) {
            $this->generateTop10('top-times.json', 'time', 'tries', $current);
        }
    }

    /*
     * Save palyer in storage
     *
     * @params $filename, $keyname1, $keyname2, $current
     *
     * @return void
     */
    private function generateTop10($filename, $keyname1, $keyname2, $current)
    {
        $json = Storage::get($filename);
        $data = json_decode($json);
        if (!$data) {
            $data = [];
        }
        if (empty($data)) {
            $data[] = $current;
        } else {
            $lastIndex = count($data) - 1;
            if (count($data) < 10) {
                $data[] = $current;
                $lastIndex++;
            } elseif (
                $data[$lastIndex]->$keyname1 > $current->$keyname1 ||
                ($data[$lastIndex]->$keyname1 == $current->$keyname1 && $data[$lastIndex]->$keyname2 > $current->$keyname2)) {
                $data[$lastIndex] = $current;
            } else {
                return;
            }
            for ($i = $lastIndex - 1; $i >= 0; $i--) {
                if (
                    $data[$i]->$keyname1 > $current->$keyname1 ||
                    ($data[$i]->$keyname1 == $current->$keyname1 && $data[$i]->$keyname2 > $current->$keyname2)) {
                    $temp = $data[$i];
                    $data[$i] = $current;
                    $data[$i + 1] = $temp;
                }
            }
        }
        $json = json_encode($data);
        Storage::put($filename, $json);
    }

    /*
     * Get top 10 players from storage
     *
     * @param $category
     *
     * @return json
     */
    public function getTop($category)
    {
        switch ($category) {
            case 'tries':
                $json = Storage::get('top-tries.json');
                break;
            case 'times':
                $json = Storage::get('top-times.json');
                break;
            default:
                $json = '';
        }
        return $json;
    }

    /*
     * Add custom rules for digit 1, 8, 4, 5 positions
     *
     * @param $generated
     *
     * return string
     */
    private function customLimitation(string $generated)
    {
        $generatedNumber = str_split($generated);
        if (in_array(1, $generatedNumber) && in_array(8, $generatedNumber)) {
            $one = array_search(1, $generatedNumber);
            $eight = array_search(8, $generatedNumber);
            if (abs($one - $eight) != 1) {
                $iterator = ($one + 1) % 4 == 0 ? -1 : 1;
                [$generatedNumber[($one + $iterator) % 4], $generatedNumber[$eight]] = [$generatedNumber[$eight], $generatedNumber[($one + $iterator) % 4]];
            }
        } else if (in_array(4, $generatedNumber) && in_array(5, $generatedNumber)) {
            $four = array_search(4, $generatedNumber);
            if ($four % 2 == 0) {
                [$generatedNumber[1], $generatedNumber[$four]] = [$generatedNumber[$four], $generatedNumber[1]];
            }
            $five = array_search(5, $generatedNumber);
            if ($five % 2 == 0) {
                [$generatedNumber[3], $generatedNumber[$five]] = [$generatedNumber[$five], $generatedNumber[3]];
            }
        }
        return implode($generatedNumber);
    }
}

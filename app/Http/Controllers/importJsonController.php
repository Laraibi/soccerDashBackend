<?php

namespace App\Http\Controllers;

use App\Models\competition;
use Illuminate\Http\Request;
use App\Models\countrie;
use App\Models\team;
use App\Models\soccerMatch;
use Illuminate\Support\Carbon;
class importJsonController extends Controller
{
    //
    public function importMatchs()
    {

        $filename = "matchsToDay.json";
        $path = storage_path() . "/app/public/json/${filename}";
        $json = json_decode(file_get_contents($path), true);
        foreach ($json as $match) {
            $countrieName = $match["country"];
            $homeTeamName = $match["home"];
            $awayTeamName = $match["away"];
            $matchTime = Carbon::parse($match["time"])->format("h:i:s"); 
            $matchCompetitionName = $match["league"];
            $matchScoreHome = $match["score"]["home"];
            $matchScoreAway = $match["score"]["away"];
            $matchDay = Carbon::createFromFormat("Y/d/m","2021/".$match["Day"])->format("Y/m/d"); 

            $countrie = countrie::where("name", $countrieName)->first();
            // dd($countrie);
            if (!$countrie) {
                $countrie = countrie::create(["name" => $countrieName]);

            }
            $homeTeam = team::where("name", $homeTeamName)->first();
            if (!$homeTeam) {
                $homeTeam = team::create(["name" => $homeTeamName]);
            }
            $awayTeam = team::where("name", $awayTeamName)->first();
            if (!$awayTeam) {
                $awayTeam = team::create(["name" => $awayTeamName]);
            }
            $competition = competition::where("name", $matchCompetitionName)->first();
            if (!$competition) {
                $competition = competition::create(["name" => $matchCompetitionName]);
            }

            $match = soccerMatch::create([

                "homeTeam_id" => $homeTeam->id,
                "awayTeam_id" => $awayTeam->id,
                "competetion_id" => $competition->id,
                "time" => $matchTime,
                "day" => $matchDay,
                "scoreAway" => empty( $matchScoreAway) || $matchScoreAway == "-" ? Null : $matchScoreAway, 
                "scoreHome" => empty( $matchScoreHome) || $matchScoreHome == "-"? Null : $matchScoreHome,

            ]);
        }
        dd(soccerMatch::all());
        return;
    }
}

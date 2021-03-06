<?php

namespace App\Http\Controllers;

use App\Models\competition;
use Illuminate\Http\Request;
use App\Models\countrie;
use App\Models\filesData;
use App\Models\team;
use App\Models\soccerMatch;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\Array_;

class importJsonController extends Controller
{
    //
    protected $pass = 'thePassWord';
    public function getAvailableFiles()
    {
        $files = Storage::files('\public\json\\');
        $filesCollection = collect($files);
        $imports = $filesCollection->map(function ($file) {
            $fileImport = filesData::where('fileName', $file)->first();
            return [
                'fileName' => $file,
                'isImported' => $fileImport  ? true : false,
                'user' => $fileImport  ? $fileImport->User : NULL,
            ];
        });
        return response()->json($imports);
    }
    public function importMatchs(Request $request)
    {
        $request->validate(['fileName' => 'required', 'Password' => 'required']);
        if ($request->Password != $this->pass) {
            return response()->json('PassWord Innexact', 302);
        }
        $filename = $request->fileName;
        $path =  storage_path() . '\\app\\' . str_replace('/', '\\', $filename);
        return $this->importMatchsFile($path);
    }
    public function importUploadedFile(Request $request)
    {
        $request->validate(['file' => 'required', 'Password' => 'required']);
        if ($request->Password != $this->pass) {
            return response()->json('PassWord Innexact', 302);
        }
        $filename = $request->fileName;
        $path =  storage_path() . '\\app\\' . str_replace('/', '\\', $filename);
        $this->importMatchsFile($path);
    }
    public function importMatchsFile(String $filePath)
    {
        $path = $filePath;
        $json = json_decode(file_get_contents($path), true);
        $counts = array("updatedCount" => 0, "insertedCount" => 0);

        foreach ($json as $match) {
            // echo "time:" . $match["time"] . "</br>";
            // continue;
            $countrieName = $match["country"];
            $homeTeamName = $match["home"];
            $awayTeamName = $match["away"];
            $matchTime = $match["time"] != "" ? Carbon::parse($match["time"])->format("H:i:s") : Null;
            $matchCompetitionName = $match["league"];
            $matchScoreHome = $match["score"]["home"];
            $matchScoreAway = $match["score"]["away"];
            $month = explode("/", $match["Day"])[1];
            $year = 2022;
            if ($month == 12) {
                $year = 2021;
            }
            // return $year;
            $matchDay = Carbon::createFromFormat("Y/d/m", $year."/" . $match["Day"])->format("Y/m/d");

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
            $competition = competition::where([
                "name" => $matchCompetitionName,
                "country_id" => $countrie->id
            ])->first();
            if (!$competition) {
                $competition = competition::create(["name" => $matchCompetitionName, "country_id" => $countrie->id]);
            }

            $match = soccerMatch::where([
                ["homeTeam_id", $homeTeam->id],
                ["awayTeam_id", $awayTeam->id],
                ["competetion_id", $competition->id],
                ["day", $matchDay],
            ])->first();
            if (!$match) {
                $match = soccerMatch::create([
                    "homeTeam_id" => $homeTeam->id,
                    "awayTeam_id" => $awayTeam->id,
                    "competetion_id" => $competition->id,
                    "time" => $matchTime,
                    "day" => $matchDay,
                    "scoreAway" => empty($matchScoreAway) || $matchScoreAway == "-" ? Null : $matchScoreAway,
                    "scoreHome" => empty($matchScoreHome) || $matchScoreHome == "-" ? Null : $matchScoreHome,
                ]);
                $counts["insertedCount"] += 1;
            } else {
                $match->update([
                    // "homeTeam_id" => $homeTeam->id,
                    // "awayTeam_id" => $awayTeam->id,
                    // "competetion_id" => $competition->id,
                    "time" => $matchTime,
                    // "day" => $matchDay,
                    "scoreAway" => empty($matchScoreAway) || $matchScoreAway == "-" ? Null : $matchScoreAway,
                    "scoreHome" => empty($matchScoreHome) || $matchScoreHome == "-" ? Null : $matchScoreHome,

                ]);
                $counts["updatedCount"] += 1;
            }
        }
        // dd(soccerMatch::all());
        // dd($counts);
        $import = filesData::create(['user_id' => auth()->user()->id, 'fileName' => $path])->load('User');
        return response()->json(['counts' => $counts, 'fileName' => $path, 'import' => $import]);
    }
}

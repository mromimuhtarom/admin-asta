<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\Dealer;
use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use DateTime;
use DateTimeZone;
use App\Log;
use Carbon\Carbon;
use App\Classes\MenucLass;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Dealer $dealer)
    {
        $tournaments = Tournament::all();

        //roles for tournaments pages
        $menus1 = MenuClass::menuName('Tournaments');

        return view('pages.game_asta.tournament', compact('tournaments', 'menus1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      if ($request->ajax()) {
        if($request->tournamentName == ''){
          return json_encode([
          "status"  => "Failed",
          "message" => "Tournament Name Must Be Filled"
          ]);
          exit;
        }

          $tournament = Tournament::create([
            'dealerId'    => Session::get('dealerId'),   //manual
            'title'       => $request->tournamentName,
            'structureId' => '1',
            'status'      => 'C'
          ]);

          Log::create([
            'operator_id' => Session::get('userId'),
            'menu_id'     => '13',
            'action_id'   => '3',
            'date'        => Carbon::now('GMT+7'),
            'description' => 'Create new Tournament with title'. $tournament->title
          ]);

          return json_encode([
            'status' => 'OK',
            'message' => 'New tournament created',
            'tournamentId' => $tournament->tournamentId
          ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament, Dealer $dealer)
    {

      //roles for tournament_edit pages
      $menus1 = MenuClass::menuName('Tournaments');

        return view('pages.tournament_edit', compact('tournament', 'dealer', 'menus1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {

        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;


        if($name == 'startAtTime') {
          // $tournament = DB::select("SELECT * FROM tournaments t join tournament_structure st on t.structureId = t.structureId where tournamentId = '".$pk."'");
          $tournament = DB::table('tournaments')
                      ->join('tournament_structure','tournaments.structureId', '=', 'tournaments.structureId')
                      ->select('*')
                      ->where('tournamentId', '=', $pk)
                      ->first();

          $value = strtotime($value.':00'.$tournament->timezone);

          $dt = new DateTime();
          $dt->setTimestamp($value);
          $dt->setTimeZone(new DateTimeZone($tournament->timezone));

          // $value = strtotime($dt->format('F j, Y, g:i a'));

          $timeLabel = $dt->format('M j, g:i a');//asli
          // $timeLabel = $dt->format('d-M-Y H:i T');

          Tournament::where('tournamentId', '=', $pk)->update([
            'timeLabel' => $timeLabel
          ]);

        }

        $updateTournament = Tournament::where('tournamentId', '=', $pk)->update([
          $name => $value
        ]);

        if($updateTournament) {

            // $tournament = DB::select("SELECT * FROM tournaments t join tournament_structure st on t.structureId = t.structureId where tournamentId = '".$pk."'");
            $tournament = DB::table('tournaments')
                        ->join('tournament_structure','tournaments.structureId', '=', 'tournaments.structureId')
                        ->select('*')
                        ->where('tournamentId', '=', $pk)
                        ->first();

            // $table = DB::select("SELECT count(*) as tables FROM poker where linkedId = '".$tournament->tournamentId."'");
            $table = DB::table('poker')
                    ->select(DB::raw('count(*) as tables'))
                    ->where('linkedId', '=', $tournament->tournamentId)
                    ->first();



            if($table->tables == 0) {
              Table::create([
                'gameNo'           => '1',
                'dealerId'         => $tournament->dealerId,
                'tablename'        => addslashes($tournament->title),
                'tabletype'        => 'm',
                'tablelow'         => $tournament->buyIn,
                'tablelimit'       => $tournament->buyIn,
                'startTime'        => $tournament->startAtTime,
                'multiplierType'   => 'structure',
                'linkedId'         => $tournament->tournamentId,
                'linkedTableNo'    => '1',
                'gameType'         => $tournament->gameType,
                'speed'            => $tournament->tspeed,
                'sb'               => $tournament->sb,
                'bb'               => $tournament->bb,
                'baseSB'           => $tournament->sb,
                'baseBB'           => $tournament->bb,
                'jackpotLow'       => '0',
                'jackpotMed'       => '0',
                'jackpotHi'        => '0',
                'playMoney'        => $tournament->tplayMoney
              ]);

            } else {

              echo 'Updating tables';

              if($name == 'status' && $value == 'C') {

                Tournament::where('tournamentId', '=', $pk)->update([
                  'registeredPlayers' => 0,
                  'finishedPlayers'   => 0,
                  'prizePool'         => 0,
                  'currentLevel'      => 1,
                  'finishTime'        => 0,
                  'tableCount'        => 1
                ]);

                // Sql::execute("DELETE FROM poker WHERE linkedId = '".$pk."'");
                // Sql::execute("DELETE FROM tournament_stats WHERE tournamentId = '".$pk."'");

              } else if ($name == 'status' && $value == 'A') {

                Table::where('linkedId', '=', $tournament->tournamentId)->update([
                  'tablename'     => addslashes($tournament->title),
                  'tabletype'     => 'm',
                  'tablelow'      => $tournament->buyIn,
                  'tablelimit'    => $tournament->buyIn,
                  'startTime'     => $tournament->startAtTime,
                  'linkedId'      => $tournament->tournamentId,
                  'linkedTableNo' => '1',
                  'gameType'      => $tournament->gameType,
                  'speed'         => $tournament->tspeed,
                  'sb'            => $tournament->sb,
                  'bb'            => $tournament->bb,
                  'baseSB'        => $tournament->sb,
                  'baseBB'        => $tournament->bb,
                  'jackpotLow'    => '0',
                  'jackpotMed'    => '0',
                  'jackpotHi'     => '0',
                  'closed'        => '0',
                  'msg'           => ''
                ]);

              } else if ($name == 'tplayMoney') {

                Table::where('linkedId', '=', $tournament->tournamentId)->update([
                  'playMoney' => $value
                ]);

              } else {

                Table::where('linkedId', '=', $tournament->tournamentId)->update([
                  'tablename'       => addslashes($tournament->title),
                  'tabletype'       => 'm',
                  'tablelow'        => $tournament->buyIn,
                  'tablelimit'      => $tournament->buyIn,
                  'startTime'       => $tournament->startAtTime,
                  'linkedId'        => $tournament->tournamentId,
                  'linkedTableNo'   => '1',
                  'gameType'        => $tournament->gameType,
                  'speed'           => $tournament->tspeed,
                  'sb'              => $tournament->sb,
                  'bb'              => $tournament->bb,
                  'baseSB'          => $tournament->sb,
                  'baseBB'          => $tournament->bb,
                  'jackpotLow'      => '0',
                  'jackpotMed'      => '0',
                  'jackpotHi'       => '0'
                ]);
              }

            }

        } else {

        }
        switch ($name) {
          case "title":
              $name = "Title";
              break;
          case "gameType":
              $name = "Game Type";
              break;
          case "buyIn":
              $name = "Buy In";
              break;
          case "entryFee":
              $name = "Entry Fee";
              break;
          case "minPlayers":
              $name = "Min Players";
              break;
          case "maxPlayers":
              $name = "Max Players";
              break;
          case "rebuys":
              $name = "Rebuys";
              break;
          case "lateEntry":
              $name = "Late Entry";
              break;
          case "structureId":
              $name = "Structure Id";
              break;
          case "status":
              $name = "Status";
              break;
          case "timezone":
              $name = "Time Zone";
              break;
          case "startAtTime":
              $name = "Start At Time";
              break;
          case "schedule":
              $name = "Schedule";
              break;
          case "schedule":
              $name = "Schedule";
              break;
          case "registrationOpens":
              $name = "Registration Opens";
              break;
          case "startingChips":
              $name = "Starting Chips";
              break;
          case "rebuyExpireMins":
              $name = "Rebuy Expire Mins";
              break;
          case "rebuyPrice":
              $name = "Rebuy Price";
              break;
          case "rebuyChips":
              $name = "Rebuy Chips";
              break;
          case "addOn":
              $name = "Add On";
              break;
          case "addOnExpireMins":
              $name = "Add On Expire Mins";
              break;
          case "addOnPrice":
              $name = "Add On Price";
              break;
          case "addOnChips":
              $name = "Add On Chip";
              break;
          case "addOnChips":
              $name = "Add On Chip";
              break;
          case "bots":
              $name = "Bots";
              break;
          default:
            "";
      }


      Log::create([
        'operator_id' => Session::get('userId'),
        'menu_id'     => '13',
        'action_id'   => '2',
        'date'        => Carbon::now('GMT+7'),
        'description' => 'Edit '.$name.' TournamentId '.$pk.' to '. $value
      ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        //
    }

    public function images(Tournament $tournament)
    {

      $images = Tournament::where('tournamentId', '=', $tournament->tournamentId)->first();
      if(!$images){
        return "image not found";
      }
      // //
      $path = public_path().'\\images\\images\\tournaments\\'.$images->promoImageUrl;
      // return Image::make($path)->response();
        return response()->file($path);
    }
}

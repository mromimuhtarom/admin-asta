<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\DmqRound;
use App\DmsRound;
use App\TpkRound;
use App\BgtRound;
use App\Game;
use App\Player;
use App\Classes\MenuClass;
use Validator;
use Illuminate\Support\Facades\Input;

class PlayReportController extends Controller
{
    
    public function index()
    {
        $game = Game::all();
        $datenow = Carbon::now('GMT+7');
        return view('pages.players.playreport', compact('game', 'datenow'));
    }

    public function modalplayreport(Request $request)
    {
       if ($request->ajax()) {
              $player_username = Player::select('user_id', 'username')->get();


              if($request->game === 'Big Two'):
                     $history = DB::table('bgt_round')->where('round_id', '=', $request->roundid)->first();
                     $response = '<table id="dt_basic" class="table-playreport-content table table-striped table-bordered table-hover" width="100%">
                                   <thead>			                
                                   <tr>
                                          <th>'.Translate_menuPlayers("L_SIT").'</th>
                                          <th>'.Translate_menuPlayers("L_USERNAME").'</th>
                                          <th>'.Translate_menuPlayers("L_CHIP_PLAYERS").'</th>
                                          <th>'.Translate_menuPlayers("L_ACTION").'</th>
                                          <th>'.Translate_menuPlayers("L_BET").'</th>
                                          <th>'.Translate_menuPlayers("L_COUNT_CARD").'</th>
                                          <th>'.Translate_menuPlayers("L_CARD_HAND").'</th>
                                          <th>'.Translate_menuPlayers("L_CARD_OUT").'</th>
                                   </tr>
                                   </thead>';
                     if($history->gameplay_log):
                     $bgt_gameplaylog = json_decode($history->gameplay_log);
                     $response .= '<tbody>';
                      foreach($bgt_gameplaylog->start->players as $start):
                      $response .=        '<tr>
                                                 <td>'.$start->seat.'</td>
                                                 <td>'.$start->username.'</td>
                                                 <td>'.number_format($start->chip).'</td>
                                                 <td>'.Translate_menuPlayers("L_NEW_ROUND").'</td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                          </tr>';
                     endforeach;
                     foreach($bgt_gameplaylog->start->players as $start):
                     $response .=         '<tr>
                                                 <td>'.$start->seat.'</td>
                                                 <td>'.$start->username.'</td>
                                                 <td></td>
                                                 <td>'.Translate_menuPlayers("L_DIVIDED_CARD").'</td>
                                                 <td></td>
                                                 <td>'.count($start->hand).'</td>
                                                 <td>';
                                                        for($a=0; $a<count($start->hand); $a++):
                                                               $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. bgtcard($start->hand)[$a] .'.png" alt="">';
                                                        endfor;
                     $response .=          '     </td>
                                                 <td></td>
                                          </tr>';
                     endforeach;
                     $arraycardbgt = array();
                     foreach($bgt_gameplaylog->acts as $action):
                     $response .=         '<tr>
                                                 <td>'. $action->seat .'</td>
                                                 <td>';
                                                 foreach($bgt_gameplaylog->start->players as $start):
                                                        if($start->seat == $action->seat):
                                                              $response .=  $start->username ;
                                                        endif;
                                                 endforeach;
                     $response .=                '</td>
                                                 <td></td>
                                                 <td>'. Translate_menuPlayers(actiongameplaylog($action->act)) .'</td>
                                                 <td></td>
                                                 <td>'. $action->left .'</td>
                                                 <td>';
                                                        foreach($bgt_gameplaylog->start->players as $start):
                                                               if($start->seat == $action->seat):                                                       
                                                                      for($i=0; $i<count($action->card); $i++):
                                                                             $arraycardbgt[] = $action->card[$i];
                                                                      endfor;

                                                                      for($a=0; $a<count($start->hand); $a++):
                                                                             if(!in_array((int)$start->hand[$a], $arraycardbgt)):
                                                                                    $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. bgtcard($start->hand)[$a] .'.png" alt="">';
                                                                             endif;
                                                                      endfor;
                                                               endif;
                                                        endforeach;
                                          
                     $response .=                '</td>
                                                 <td>';
                                                 for($i=0; $i<count($action->card); $i++):
                                                       $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. bgtcard($action->card)[$i] .'.png" alt="">';
                                                 endfor;
                     $response .=                 '</td>
                                          </tr>';
                     endforeach;
                     foreach($bgt_gameplaylog->end->players as $end):
                     $response .=         '<tr>
                                                 <td>'. $end->seat .'</td>
                                                 <td>';
                                                        foreach($bgt_gameplaylog->start->players as $start):
                                                               if($start->seat == $end->seat):
                                                                      $response .= $start->username;
                                                               endif;
                                                        endforeach;
                     $response .=                '</td>
                                                 <td>'. number_format($end->chip) .'</td>
                                                 <td>'. Translate_menuPlayers(statusgameplaylog($end->stat)) .'</td>
                                                 <td>
                                                 '. number_format($end->val) .' <br>';
                                                 if($end->stat !== 0):
                     $response .=                '(fee:'. number_format($end->fee) .')';
                                                 endif;

                     $response .=                '</td>
                                                 <td>'. count($end->hand) .'</td>
                                                 <td>';
                                                 for($a=0; $a<count($end->hand); $a++):
                                                        $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. bgtcard($end->hand)[$a] .'.png" alt="">';
                                                 endfor;
                     $response .=                 '</td>
                                                 <td></td>
                                          </tr>';
                     endforeach;

                     $response .=  '</tbody>
                     </table>   ';
                     endif;
              elseif($request->game === 'Texas Poker'):
                     $history = DB::table('tpk_round')->where('round_id', '=', $request->roundid)->first();
                     $response = '<table id="dt_basic" class="table-playreport-content table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>'. Translate_menuPlayers("L_SIT") .'</th>
                                    <th>'. Translate_menuPlayers("L_USERNAME") .'</th>
                                    <th>'. Translate_menuPlayers("L_CHIP_PLAYERS") .'</th>
                                    <th>'. Translate_menuPlayers("L_ACTION") .'</th>
                                    <th>'. Translate_menuPlayers("L_BET") .'</th>
                                    <th>'. Translate_menuPlayers("L_CARD_TYPE") .'</th>
                                    <th>'. Translate_menuPlayers("L_CARD_HAND") .'</th>
                                    <th>'. Translate_menuPlayers("L_CARD_TABLE") .'</th>
                                </tr>
                            </thead>';

                            if(!empty($history->gameplay_log)):
                                $tpk_gameplaylog = json_decode($history->gameplay_log);
                     $response .=  '<tbody> ';
                                          foreach($tpk_gameplaylog->start->players as $start):
                     $response .=                '<tr>
                                                        <td>'. $start->seat .'</td>
                                                        <td>';
                                                               foreach($player_username as $plyr):
                                                                      if($start->uid == $plyr->user_id):
                                                                             $response .= $plyr->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($start->chip) .'</td>
                                                        <td>'. Translate_menuPlayers("L_NEW_ROUND") .'</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                 </tr>';
                                          endforeach;  
                                          foreach($tpk_gameplaylog->start->players as $start):
                                          if($start->seat == $tpk_gameplaylog->start->turn):
                     $response .=               '<tr>
                                                        <td>'. $start->seat .'</td>
                                                        <td>';
                                                               foreach($player_username as $plyr):
                                                                      if($start->uid == $plyr->user_id):
                                                                             $response .= $plyr->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($start->chip) .'</td>
                                                        <td>'. Translate_menuPlayers('L_DEALER') .'</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>';
                                                               if(!empty($start->hand)):
                                                                      for($a=0; $a<count($start->hand); $a++):
                                                                             $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($start->hand)[$a] .'.png" alt="">';
                                                                      endfor;
                                                               endif;
                     $response .=                       '</td>
                                                        <td></td>
                                                 </tr>';
                                          endif;
                                          endforeach;

                                          $b = 1;
                                          foreach($tpk_gameplaylog->acts as $action):
                                          if($action->act == 7 || $action->act == 8):
                     $response .=                '<tr>
                                                        <td>'. $action->seat .'</td>
                                                        <td>';
                                                               foreach($tpk_gameplaylog->start->players as $start):
                                                                      if($start->seat == $action->seat ):
                                                                             foreach($player_username as $plyr):
                                                                                    if($start->uid == $plyr->user_id):
                                                                                           $response .= $plyr->username;
                                                                                    endif;
                                                                             endforeach;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($action->chip) .'</td>
                                                        <td>'. Translate_menuPlayers(actiongameplaylog($action->act)) .'</td>
                                                        <td>'. number_format($action->bet) .'</td>
                                                        <td></td>
                                                        <td>';
                                                               foreach ($tpk_gameplaylog->start->players as $start):
                                                                      if($start->seat == $action->seat):
                                                                             if(!empty($start->hand)):
                                                                                    for($a=0; $a<count($start->hand); $a++):
                                                                                           $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($start->hand)[$a] .'.png" alt="">';
                                                                                    endfor;
                                                                             endif;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td></td>
                                                 </tr>';
                                        elseif($action->act == 9):
                     $response .=                '<tr>
                                                        <td></td>
                                                        <td>'. Translate_menuPlayers(actiongameplaylog($action->act)) .'</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>';
                                                               if(!empty($tpk_gameplaylog->start->table_card)):
                                                                      if($b == 1):
                                                                             for($a=0; $a<3; $a++):
                                                                                    $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($tpk_gameplaylog->start->table_card)[$a] .'.png" alt="">';
                                                                             endfor;
                                                                      elseif($b == 2):
                                                                             for($a=0; $a<4; $a++):
                                                                                    $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($tpk_gameplaylog->start->table_card)[$a] .'.png" alt="">';
                                                                             endfor;
                                                                      elseif($b == 3):
                                                                             for($a=0; $a<5; $a++):
                                                                                    $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($tpk_gameplaylog->start->table_card)[$a] .'.png" alt="">';
                                                                             endfor;
                                                                      endif;
                                                               endif;
                     $response .=                        '</td>
                                                 </tr>';
                                          $b++;
                                          else:
                      $response .=               '<tr>
                                                        <td>'. $action->seat .'</td>
                                                        <td>';
                                                               foreach($tpk_gameplaylog->start->players as $start):
                                                                      if($start->seat == $action->seat ):
                                                                             foreach($player_username as $plyr):
                                                                                    if($start->uid == $plyr->user_id):
                                                                                           $response .= $plyr->username;
                                                                                    endif;
                                                                             endforeach;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($action->chip) .'</td>
                                                        <td>'. Translate_menuPlayers(actiongameplaylog($action->act)) .'</td>
                                                        <td>'. number_format($action->bet) .'</td>
                                                        <td></td>
                                                        <td>';
                                                               if($action->act == 4):
                                                                      foreach($tpk_gameplaylog->start->players as $start):
                                                                             if($start->seat == $action->seat):
                                                                                    if(!empty($start->hand)):
                                                                                           for($a=0; $a<count($start->hand); $a++):
                                                                                                  $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($start->hand)[$a] .'.png" alt="">';
                                                                                           endfor;
                                                                                    endif;
                                                                             endif;
                                                                      endforeach;
                                                               else: 
                                                                      foreach($tpk_gameplaylog->start->players as $start):
                                                                             if($start->seat == $action->seat):
                                                                                    if(!empty($start->hand)):
                                                                                           for($a=0; $a<count($start->hand); $a++):
                                                                                           $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($start->hand)[$a] .'.png" alt="">';
                                                                                           endfor;
                                                                                    endif;
                                                                             endif;
                                                                      endforeach;
                                                               endif;
                     $response .=                       '</td>
                                                        <td>

                                                        </td>
                                                 </tr>'; 
                                          endif;
                                          endforeach;  
                                    
                                          foreach($tpk_gameplaylog->end->players as $end):
                     $response .=                '<tr>
                                                        <td>'. $end->seat .'</td>
                                                        <td>';
                                                               foreach($tpk_gameplaylog->start->players as $start):
                                                                      if($start->seat == $end->seat ):
                                                                             foreach($player_username as $plyr):
                                                                                    if($start->uid == $plyr->user_id):
                                                                                           $response .= $plyr->username;
                                                                                    endif;
                                                                             endforeach;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($end->chip) .'</td>
                                                        <td>'. Translate_menuPlayers(statusgameplaylog($end->stat)) .'</td>
                                                        <td>
                                                               '. number_format($end->val) .' <br> ';
                                                               if($end->stat !== 0):
                                                                      $response .= '(fee:'. number_format($end->fee) .') <br>';
                                                               endif;
                     $response .=                       '</td>
                                                        <td>'. Translate_menuPlayers(typeCardGamepLayLogBgtTpk($end->type)) .'</td>
                                                        <td>';
                                                               if($end->type !== null):
                                                                      foreach($tpk_gameplaylog->start->players as $start):
                                                                             if($start->seat == $end->seat):

                                                                                    for($a=0; $a<count($start->hand); $a++):
                                                                                           if(!empty($start->hand)):
                                                                                                  if(in_array((int)$start->hand[$a], $end->hand, false)):
                                                                                                         $response .= '<img style="width:38px;height:auto;border:3px solid yellow;" src="/assets/img/card_bgt_tpk/'. tpkcard($start->hand)[$a] .'.png" alt="">';
                                                                                                  else:
                                                                                                         $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($start->hand)[$a] .'.png" alt="">';
                                                                                                  endif;
                                                                                           endif;
                                                                                    endfor;

                                                                             endif;
                                                                      endforeach;
                                                               else:
                                                                      foreach($tpk_gameplaylog->start->players as $start):
                                                                             if($start->seat == $end->seat):
                                                                                    if(!empty($start->hand)):
                                                                                           for($a=0; $a<count($start->hand); $a++):
                                                                                                  $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($start->hand)[$a] .'.png" alt="">';
                                                                                           endfor;
                                                                                    endif;
                                                                             endif;
                                                                      endforeach;
                                                               endif;
                     $response .=                       '</td>
                                                        <td>';
                                                               for($a=0; $a<count($tpk_gameplaylog->start->table_card); $a++):
                                                                      if(!empty($tpk_gameplaylog->start->table_card)):
                                                                             if(in_array((int)$tpk_gameplaylog->start->table_card[$a], $end->hand, false)):
                                                                                    $response .= '<img style="width:38px;height:auto;border:3px solid yellow;" src="/assets/img/card_bgt_tpk/'. tpkcard($tpk_gameplaylog->start->table_card)[$a] .'.png" alt="">';
                                                                             else:
                                                                                    $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_bgt_tpk/'. tpkcard($tpk_gameplaylog->start->table_card)[$a] .'.png" alt="">';
                                                                             endif;
                                                                      endif;
                                                               endfor;
                     $response .=                       '</td>
                                                 </tr>';
                                          endforeach;
                     $response .= '</tbody>';
                            endif;
                    $response .= '</table>';  
              
              elseif($request->game === 'Domino Susun'):
                     $history = DB::table('dms_round')->where('round_id', '=', $request->roundid)->first();
                    $response = '<table id="dt_basic" class="table-playreport-content table table-striped table-bordered table-hover" width="100%">
                        <thead>			                
                            <tr>
                                <th>'. Translate_menuPlayers("L_SIT") .'</th>
                                <th>'. Translate_menuPlayers("L_USERNAME") .'</th>
                                <th>'. Translate_menuPlayers("L_CHIP_PLAYERS") .'</th>
                                <th>'. Translate_menuPlayers("L_ACTION") .'</th>
                                <th>'. Translate_menuPlayers("L_BET") .'</th>
                                <th>'. Translate_menuPlayers("L_COUNT_CARD") .'</th>
                                <th>'. Translate_menuPlayers("L_CARD_HAND") .'</th>
                                <th>'. Translate_menuPlayers("L_CARD_OUT") .'</th>
                            </tr>
                        </thead>';
                        if($history->gameplay_log): 
                            $dms_gameplaylog = json_decode($history->gameplay_log);
                     $response .= '<tbody>';
                                          foreach($dms_gameplaylog->start->players as $start):
                     $response .=               '<tr>
                                                        <td>'. $start->seat .'</td>
                                                        <td>';
                                                               foreach($player_username as $plyr):
                                                                      if($start->uid == $plyr->user_id):
                                                                             $response .= $plyr->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($start->chip) .'</td>
                                                        <td>'. Translate_menuPlayers("L_NEW_ROUND") .'</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                 </tr>';
                                          endforeach;    


                                          foreach($dms_gameplaylog->start->players as $start):
                     $response .=                '<tr>
                                                        <td>'. $start->seat .'</td>
                                                        <td>'. $start->username .'</td>
                                                        <td>';
                                                               foreach($dms_gameplaylog->acts as $action):
                                                                      if($action->act == 9 && $action->seat == $start->seat):
                                                                             $response .= number_format($action->chip);
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. Translate_menuPlayers("L_DIVIDED_CARD") .'</td>
                                                        <td>'. number_format($dms_gameplaylog->start->stake) .'</td>
                                                        <td>'. count($start->hand) .'</td>
                                                        <td></td>
                                                        <td></td>
                                                 </tr>';
                                          endforeach;

                                          $arraycarddms = array();
                                          foreach($dms_gameplaylog->acts as $action):
                                          if($action->act != 9):
                     $response .=                '<tr>
                                                        <td>'. $action->seat .'</td>
                                                        <td>';
                                                               foreach($dms_gameplaylog->start->players as $start):
                                                                      if($start->seat == $action->seat):
                                                                             $response .= $start->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                        '</td>
                                                        <td></td>
                                                        <td>'. Translate_menuPlayers(actiongameplaylog($action->act)) .'</td>
                                                        <td></td>
                                                        <td>';
                                                        foreach($dms_gameplaylog->start->players as $start):
                                                               if($start->seat == $action->seat):                                                        
                                                                      for($i=0; $i<count($action->card); $i++):
                                                                             $arraycarddms[] = $action->card[$i];
                                                                      endfor;
                                                                      $response .= count(array_diff($start->hand, $arraycarddms));
                                                               endif;
                                                        endforeach;
                     $response .=                       '</td>
                                                        <td>';
                                                               foreach($dms_gameplaylog->start->players as $start):
                                                                      if($start->seat == $action->seat):   
                                                                             for($a=0; $a<count($start->hand); $a++):
                                                                                    if(!in_array((int)$start->hand[$a], $arraycarddms)):
                                                                                           $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/'. dmscard($start->hand)[$a] .'.png" alt="">';
                                                                                    endif;
                                                                             endfor;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>';
                                                               for($i=0; $i<count($action->card); $i++):
                                                                      $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/'. dmscard($action->card)[$i] .'.png" alt="">';
                                                               endfor;
                     $response .=                       '</td>
                                                 </tr>';
                                          endif;
                                          endforeach;

                                          foreach($dms_gameplaylog->end->players as $end):
                     $response .=                '<tr>
                                                        <td>'. $end->seat .'</td>
                                                        <td>';
                                                               foreach($dms_gameplaylog->start->players as $start):
                                                                      if($start->seat == $end->seat):
                                                                             $response .= $start->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($end->chip) .'</td>
                                                        <td>'. 
                                                               Translate_menuPlayers(statusgameplaylog($end->stat)) .'<br>';
                                                               if($end->type !== 0):
                                                                      $response .= Translate_menuPlayers(typecarddms($end->type));
                                                               endif;
                     $response .=                       '</td>
                                                        <td>
                                                               '. number_format($end->val) .' <br> ';
                                                               if($end->stat !== 0):
                     $response .=                              '(fee:'. number_format($end->fee) .')<br>';
                                                               endif;
                     $response .=                       '</td>
                                                        <td>'. count($end->hand) .'</td>
                                                        <td>';
                                                               for($a=0; $a<count($end->hand); $a++):
                                                                      $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/'. dmscard($end->hand)[$a] .'.png" alt="">';
                                                               endfor;
                     $response .=                       '</td>
                                                        <td></td>
                                                 </tr>';
                                          endforeach;
                                      
                     $response .= '</tbody>';
                        endif;
                    $response .= '</table>';        
              elseif($request->game === 'Domino QQ'):
                     $history = DB::table('dmq_round')->where('round_id', '=', $request->roundid)->first();
                     $response = '<table id="dt_basic" class="table-playreport-content table table-striped table-bordered table-hover" width="100%">
                            <thead>			                
                                <tr>
                                    <th>'. Translate_menuPlayers("L_SIT") .'</th>
                                    <th>'. Translate_menuPlayers("L_USERNAME") .'</th>
                                    <th>'. Translate_menuPlayers("L_CHIP_PLAYERS") .'</th>
                                    <th>'. Translate_menuPlayers("L_ACTION") .'</th>
                                    <th>'. Translate_menuPlayers("L_BET") .'</th>
                                    <th>'. Translate_menuPlayers("L_CARD_VALUE") .'</th>
                                    <th>'. Translate_menuPlayers("L_CARD_HAND") .'</th>
                                </tr>
                            </thead>';
                            if($history->gameplay_log): 
                                $dmq_gameplaylog = json_decode($history->gameplay_log);
                     $response .=  '<tbody>';  
                                          foreach($dmq_gameplaylog->start->players as $start):
                     $response .=                '<tr>
                                                        <td>'. $start->seat .'</td>
                                                        <td>';
                                                               foreach($player_username as $plyr):
                                                                      if($start->uid == $plyr->user_id):
                                                                             $response .= $plyr->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($start->chip) .'</td>
                                                        <td>'. Translate_menuPlayers('L_NEW_ROUND') .'</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                 </tr>';
                                          endforeach;  

                                          $a = 0;
                                          $draw = array_count_values(array_column($dmq_gameplaylog->acts, 'act'))[9];
                                          foreach($dmq_gameplaylog->acts as $key => $action):
                                          if($action->act == 9):
                     $response .=                '<tr>
                                                        <td>'. $action->seat .'</td>
                                                        <td>';
                                                               foreach($dmq_gameplaylog->start->players as $start):
                                                                      if($start->seat == $action->seat):
                                                                             $response .= $start->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($action->chip) .'</td>
                                                        <td>'. Translate_menuPlayers(actiongameplaylog($action->act)) .'</td>
                                                        <td>'. number_format($action->bet) .'</td>
                                                        <td></td>
                                                        <td>';
                                                               if(!empty($action->card)):
                                                                      for($i=0; $i<count($action->card); $i++):
                                                                             $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/'. dmscard($action->card)[$i] .'.png" alt="">';
                                                                      endfor; 
                                                               endif;                                                                                           
                     $response .=                       '</td>
                                                 </tr>';
                                          else:
                     $response .=                '<tr>
                                                        <td>'. $action->seat .'</td>
                                                        <td>';
                                                               foreach($dmq_gameplaylog->start->players as $start):
                                                                      if($start->seat == $action->seat):
                                                                             $response .=$start->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($action->chip) .'</td>
                                                        <td>'. Translate_menuPlayers(actiongameplaylog($action->act)) .'</td>
                                                        <td>'. number_format($action->bet) .'</td>
                                                        <td></td>
                                                        <td>';
                                                               if($action->act === 4):
                                                                      foreach($dmq_gameplaylog->start->players as $start):
                                                                             if($start->seat == $action->seat):
                                                                                    for($i=0; $i<count($start->hand); $i++):
                                                                                           $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/'. dmscard($start->hand)[$i] .'.png" alt="">';
                                                                                    endfor;
                                                                             endif;
                                                                      endforeach;
                                                               endif;
                     $response .=                       '</td>
                                                 </tr>';
                                          endif; 
                                          $a++;
                                          endforeach;                  


                                          foreach($dmq_gameplaylog->end->players as $end):
                     $response .=                '<tr>
                                                        <td>'. $end->seat .'</td>
                                                        <td>';
                                                               foreach($dmq_gameplaylog->start->players as $start):
                                                                      if($start->seat == $end->seat):
                                                                             $response .= $start->username;
                                                                      endif;
                                                               endforeach;
                     $response .=                       '</td>
                                                        <td>'. number_format($end->chip) .'</td>
                                                        <td>'. Translate_menuPlayers(statusgameplaylog($end->stat)) .'</td>
                                                        <td>
                                                        '. number_format($end->val) .' <br>';
                                                               if($end->stat !== 0):
                                                                      $response .= '(fee:'. number_format($end->fee) .')';
                                                               endif;
                     $response .=                       '</td>
                                                        <td>';
                                                               for($i=0; $i<count($end->combo); $i++):
                                                                      if($end->type === 0):
                                                                      if($i == 0):
                                                                             $response .= $end->combo[$i].' :';
                                                                      else:
                                                                             $response .= $end->combo[$i];
                                                                      endif;
                                                                      else:
                                                                             $response .= typecarddmq($end->type);
                                                                      endif;
                                                                      
                                                               endfor;
                     $response .=                       '</td>
                                                        <td>';
                                                               foreach($dmq_gameplaylog->start->players as $start):
                                                                      if($end->seat == $start->seat):
                                                                             for($a=0; $a<count($start->hand); $a++):
                                                                                    $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/'. dmscard($start->hand)[$a] .'.png" alt="">';
                                                                             endfor;
                                                                      endif;
                                                               endforeach;
                                                               // if($end->hand):
                                                               //        for($a=0; $a<count($end->hand); $a++):
                                                               //               $response .= '<img style="width:34px;height:auto;" src="/assets/img/card_dms_dmq/'. dmscard($end->hand)[$a] .'.png" alt="">';
                                                               //        endfor;
                                                               // endif;
                     $response .=                       '</td>
                                                 </tr>';
                                          endforeach;
                     $response .= '</tbody>';
                            endif;
                    $response .= '</table>';

              endif;
                     return json_encode([
                            "roundid"  => $request->roundid,
                            "tablecontent" => $response
                     ]);

      }
    }

    public function search(Request $request)
    {

      $inputName    = $request->inputPlayer;
      $inputMinDate = $request->inputMinDate;
      $inputGame    = $request->inputGame;
      $inputMaxDate = $request->inputMaxDate;
      $inputRoundID = $request->inputRoundID;
      $sorting      = $request->sorting;
      $namecolumn   = $request->namecolumn;
      $menus1       = MenuClass::menuName('Report');
      $game         = Game::all();

      
       $validator = Validator::make($request->all(),[
              'inputMinDate' => 'required|date',
              'inputMaxDate' => 'required|date',
              'inputGame'    => 'required',
       ]);

       if ($validator->fails()) {
              return back()->withErrors($validator->errors());
       }

      if($inputMaxDate < $inputMinDate){
       return back()->with('alert', alertTranslate("L_CANT_LESS_THAN"));
      }
        // if sorting variable is null
        if($sorting == NULL):
          $sorting = 'desc';
        endif;

        if(Input::get('sorting') === 'asc'):
          $sortingorder = 'desc';
        else:
          $sortingorder = 'asc';
        endif;
        
        $getMindate  = Input::get('inputMinDate');
        $getMaxdate  = Input::get('inputMaxDate');
        $getusername = Input::get('inputPlayer');
        $getgame     = Input::get('inputGame');
        $getroundid  = Input::get('inputRoundID');


      $player_username = Player::select('user_id', 'username')->get();

      
      $tbdmq = DmqRound::join('asta_db.dmq_round_player', 'asta_db.dmq_round_player.round_id', '=', 'asta_db.dmq_round.round_id')
               ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dmq_round_player.user_id')
               ->join('asta_db.dmq_table', 'asta_db.dmq_table.table_id', '=', 'asta_db.dmq_round.table_id')
               ->select(
                         'asta_db.dmq_round.gameplay_log AS gameplay_log',
                         'asta_db.dmq_round.date as datetimeround',
                         'asta_db.dmq_table.name AS tablename',
                         'asta_db.dmq_round_player.bet AS bet',
                         'asta_db.dmq_round_player.round_id as round_id',
                         'asta_db.dmq_round_player.win_lose as win_lose',
                         'asta_db.dmq_round_player.status as status',
                         'asta_db.dmq_round_player.hand_card as hand_card_round',
                         'asta_db.dmq_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                        DB::raw("'Domino QQ' AS gamename") 
                       );
       $tbdms = DmsRound::join('asta_db.dms_round_player', 'asta_db.dms_round.round_id', '=', 'asta_db.dms_round_player.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.dms_round_player.user_id')
                ->join('asta_db.dms_table', 'asta_db.dms_table.table_id', '=', 'asta_db.dms_round.table_id')
                ->select(
                         'asta_db.dms_round.gameplay_log as gameplay_log',
                         'asta_db.dms_round.date As datetimeround',
                         'asta_db.dms_table.name AS tablename',
                         'asta_db.dms_round_player.bet as bet',
                         'asta_db.dms_round_player.round_id as round_id',
                         'asta_db.dms_round_player.win_lose as win_lose',
                         'asta_db.dms_round_player.status as status',
                         'asta_db.dms_round_player.hand_card as hand_card_round',
                         'asta_db.dms_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Domino Susun' AS gamename")
                     );
       $tbbgt = BgtRound::join('asta_db.bgt_round_player', 'asta_db.bgt_round_player.round_id', '=', 'asta_db.bgt_round.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.bgt_round_player.user_id')
                ->join('asta_db.bgt_table', 'asta_db.bgt_table.table_id', '=', 'asta_db.bgt_round.table_id')
                ->select(
                         'asta_db.bgt_round.gameplay_log as gameplay_log',
                         'asta_db.bgt_round.date As datetimeround',
                         'asta_db.bgt_table.name AS tablename',
                         'asta_db.bgt_round_player.bet as bet',
                         'asta_db.bgt_round_player.round_id as round_id',
                         'asta_db.bgt_round_player.win_lose as win_lose',
                         'asta_db.bgt_round_player.status as status',
                         'asta_db.bgt_round_player.hand_card as hand_card_round',
                         'asta_db.bgt_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Big Two' AS gamename")
                        );
       $tbtpk = TpkRound::join('asta_db.tpk_round_player', 'asta_db.tpk_round.round_id', '=', 'asta_db.tpk_round_player.round_id')
                ->join('asta_db.user', 'asta_db.user.user_id', '=', 'asta_db.tpk_round_player.user_id')
                ->join('asta_db.tpk_table', 'asta_db.tpk_table.table_id', '=', 'asta_db.tpk_round.table_id')
                ->select(
                         'asta_db.tpk_round.gameplay_log as gameplay_log',
                         'asta_db.tpk_round.date As datetimeround',
                         'asta_db.tpk_table.name AS tablename',
                         'asta_db.tpk_round_player.bet as bet',
                         'asta_db.tpk_round_player.round_id as round_id',
                         'asta_db.tpk_round_player.win_lose as win_lose',
                         'asta_db.tpk_round_player.status as status',
                         'asta_db.tpk_round_player.hand_card as hand_card_round',
                         'asta_db.tpk_round_player.seat_id as seat_id',
                         'asta_db.user.username',
                         'asta_db.user.user_id',
                         DB::raw("'Texas Poker' AS gamename")
                        );
                        
       if($inputGame == 'Domino QQ'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.dmq_round.date';
              endif;
              $gettableroundplayer = 'dmq_round_player';
       elseif($inputGame == 'Domino Susun'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.dms_round.date';
              endif;
              $gettableroundplayer = 'dms_round_player';
       elseif($inputGame == 'Texas Poker'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.tpk_round.date';
              endif;
              $gettableroundplayer = 'tpk_round_player';
       elseif($inputGame == 'Big Two'):
              if($namecolumn == NULL):
                     $namecolumn = 'asta_db.bgt_round.date';
              endif;
              $gettableroundplayer = 'bgt_round_player';
       endif;

       
      if($inputName != NULL && $inputRoundID != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
              
       } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;

       } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.tpk_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.tpk_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);  
              endif;
       } else if ($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.bgt_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->where('asta_db.bgt_round.round_id', '=', $inputRoundID)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
      } else if($inputRoundID != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        
        if($inputGame == 'Domino QQ'):
        $player_history = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dmq_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        elseif($inputGame == 'Domino Susun'):
        $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.dms_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        elseif($inputGame == 'Texas Poker'):
        $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.tpk_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        elseif($inputGame == 'Big Two'):
        $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
              ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
              ->where('asta_db.bgt_round.round_id', '=', $inputRoundID)
              ->orderby($namecolumn, $sorting)
              ->paginate(20);
        endif;
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
      } 
      else if($inputName != NULL && $inputMinDate != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if ($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
      } else if($inputName != NULL && $inputMinDate != NULL && $inputGame != NULL) {
       
        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '>=', $inputMinDate." 00:00:00")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
       $player_history->appends($request->all());
       return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'inputName', 'inputMinDate', 'inputMaxDate', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));

      } else if($inputName != NULL && $inputMaxDate != NULL && $inputGame != NULL) {
        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;

        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->where('asta_db.dmq_round.date', '<=', $inputMaxDate." 23:59:59")
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
    } else if($inputName != NULL && $inputGame != NULL) {

        if($inputGame == 'Domino QQ') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdmq->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdmq->where('asta_db.dmq_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Domino Susun') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbdms->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbdms->where('asta_db.dms_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Texas Poker') {
              if(is_numeric($inputName) !== true):
                     $player_history  = $tbtpk->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history  = $tbtpk->where('asta_db.tpk_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        } else if($inputGame == 'Big Two') {
              if(is_numeric($inputName) !== true):
                     $player_history = $tbbgt->where('asta_db.user.username', 'LIKE', '%'.$inputName.'%')
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              else:
                     $player_history = $tbbgt->where('asta_db.bgt_round_player.user_id', '=', $inputName)
                            ->orderby($namecolumn, $sorting)
                            ->paginate(20);
              endif;
        }
        $player_history->appends($request->all());
        return view('pages.players.playreport', compact('player_history', 'player_username', 'menus1', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
    } else if($inputGame != NULL && $inputMinDate != NULL && $inputMaxDate != NULL) {
       if($inputGame == 'Domino QQ') {
        $player_history = $tbdmq->wherebetween('asta_db.dmq_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->orderby($namecolumn, $sorting)
                          ->paginate(20);
        } else if($inputGame == 'Domino Susun') {
        $player_history = $tbdms->wherebetween('asta_db.dms_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->orderby($namecolumn, $sorting)
                          ->paginate(20);
        } else if($inputGame == 'Texas Poker') {
        $player_history  = $tbtpk->wherebetween('asta_db.tpk_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                           ->orderby($namecolumn, $sorting)
                           ->paginate(20);
        } else if($inputGame == 'Big Two') {
        $player_history = $tbbgt->wherebetween('asta_db.bgt_round.date' ,[$inputMinDate." 00:00:00", $inputMaxDate." 23:59:59"])
                          ->orderby($namecolumn, $sorting)
                          ->paginate(20);
        }
        $player_history->appends($request->all());

       
       
        return view('pages.players.playreport', compact('player_history', 'player_username','inputMaxDate', 'inputMinDate', 'inputGame', 'menus1', 'game', 'sortingorder', 'getMindate', 'getMaxdate', 'getusername', 'getgame', 'getroundid'));
    }
    
  }
}

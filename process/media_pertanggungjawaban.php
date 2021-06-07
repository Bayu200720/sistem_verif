<?php

require __DIR__.'/../includes/load.php';

$pertanggungjawabanPage = '../Pertanggungjawaban.php';

$user = find_by_id('users',(int)$_SESSION['user_id']);
$pengajuan = find_by_id('pengajuan',$_GET['id']);

if(isset($_POST['submit'])) {
  $id = $_POST['id'];
  $photo = new Media();
  $photo->upload($_FILES['file_upload'], $pengajuan['SPM']);
  if($photo->process_pertanggungjawaban($id)){
      // $session->msg('s','dokumen has been uploaded.');
      // if($user['user_level'] == 5){
      //   redirect($pertanggungjawabanPage, false);
      // }else{
      //   redirect($pertanggungjawabanPage.'?id='.$pengajuan['id']);
      // }
      return json_encode([
        'success' => true,
        'data' => [
          'user_id' => $user['user_level'],
          'id' => $pengajuan['id']
        ],
        'message' => 'dokumen has been uploaded.'
      ]);
  } else{
    // $session->msg('d',join($photo->errors));
    // if($user['user_level'] == 5){
    //   redirect($pertanggungjawabanPage.'?id='.$pengajuan['id'], false);
    // }else{
    //   redirect($pertanggungjawabanPage.'?id='.$pengajuan['id']);
    // }
    return json_encode([
      'success' => false,
      'data' => [
        'user_id' => $user['user_level'],
        'id' => $pengajuan['id']
      ],
      'message' => join($photo->errors)
    ]);
  }
}

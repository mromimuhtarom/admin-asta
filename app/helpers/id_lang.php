<?php

// function xmlfile()
// {
//     // $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
//     $xml = simplexml_load_file("../public/upload/xml/Language/Indonesia/language.xml");
    
//     return $xml;
// }

//===========================TRANSLATE SIDEMENU===========================//
function translate_menu($menu){

    // dd(xmlfile()->L_Email_Notification->attributes()->val);
  
    $array_menu = [
      'L_DASHBOARD'                         => 'Dasbor',
      'L_ADMIN'                             => 'Admin',
      'L_USER_ADMIN'                        => 'Pengguna Admin',
      'L_ROLE_ADMIN'                        => 'Peran Admin',
      'L_LOG_ADMIN'                         => 'Catatan Admin',
      'L_ACTIVE_ADMIN'                      => 'Admin aktif',
      'L_REPORT_ADMIN'                      => 'Laporan admin',
      'L_TRANSACTION'                       => 'Transaksi',
      'L_TRANSACTION_DAY'                   => 'Transaksi Harian',
      'L_USER_BANK_TRANSACTION'             => 'Transaksi Bank Pemain',
      'L_REWARD_TRANSACTION'                => 'Reward Transaksi',
      'L_ADD_TRANSACTION'                   => 'Tambah transaksi',
      'L_TRANSACTION_POINT'                 => 'Transaksi Point',
      'L_PLAYERS'                           => 'Pemain',
      'L_ACTIVE_PLAYERS'                    => 'Pemain aktif',
      'L_REPORT_PLAYERS'                    => 'Laporan pemain',
      'L_HIGH_ROLLER'                       => 'High roller',
      'L_REGISTERED_PLAYERS'                => 'Pemain terdaftar',
      'L_GUEST'                             => 'Guest',
      'L_BOTS'                              => 'Bot',
      'L_PLAY_REPORT'                       => 'Laporan permainan',
      'L_CHIP_PLAYERS'                      => 'Chip pemain',
      'L_GOLD_PLAYERS'                      => 'Koin pemain',
      'L_POINT_PLAYERS'                     => 'Poin pemain',
      'L_REGISTER_PLAYER_ID'                => 'ID pemain terdaftar',
      'L_LOG_PLAYER'                        => 'Catatan Pemain',
      'L_TRANSACTION_PLAYERS'               => 'Transaksi pemain',
      'L_PLAYERS_LEVEL'                     => 'Level pemain',
      'L_AVATAR_PLAYER'                     => 'avatar pemain',
      'L_SLIDE_BANNER'                      => 'Slide spanduk',
      'L_ITEM'                              => 'Item',
      'L_TABLE_GIFT'                        => 'Table gift',
      'L_REPORT_GIFT'                       => 'Laporan gift',
      'L_EMOTICON'                          => 'Emoticon',
      'L_GAMES'                             => 'Permainan',
      'L_ASTA_POKER'                        => 'Asta-Poker',
      'L_TABLE_ASTA_POKER'                  => 'Table Asta poker',
      'L_CATEGORY_ASTA_POKER'               => 'Kategori',
      'L_SEASON_ASTA_POKER'                 => 'Musim Asta Poker',
      'L_SEASON_REWARD_ASTA_POKER'          => 'Hadiah musim Asta Poker',
      'L_TOURNAMENT_ASTA_POKER'             => 'Turnamen Asta Poker',
      'L_JACKPOT_PAYTABLE_ASTA_POKER'       => 'Jackpot Paytable Asta Poker',
      'L_MONITORING_TABLE_ASTA_POKER'       => 'Monitor Meja',
      'L_BIG_TWO'                           => 'Big Two',
      'L_TABLE_BIG_TWO'                     => 'Table Big Two',
      'L_CATEGORY_BIG_TWO'                  => 'Kategori Big Two',
      'L_SEASON_BIG_TWO'                    => 'Musim Big Two',
      'L_SEASON_REWARD_BIG _TWO'            => 'Hadiah musim Big Two',
      'L_TOURNAMENT_BIG_TWO'                => 'Turnamen Big Two',
      'L_JACKPOT_PAYTABLE_BIG_TWO'          => 'Jackpot Paytable Big Two',
      'L_DOMINO_SUSUN'                      => 'Domino susun',
      'L_TABLE_DOMINO_SUSUN'                => 'Table domino susun',
      'L_CATEGORY_DOMINO_SUSUN'             => 'Kategori domino susun',
      'L_SEASON_DOMINO_SUSUN'               => 'Musim domino susun',
      'L_SEASON_REWARD_DOMINO_SUSUN'        => 'Hadiah musim Domino susun',
      'L_TOURNAMENT_DOMINO_SUSUN'           => 'Turnamen Domino susun',
      'L_JACKPOT_PAYTABLE_DOMINO_SUSUN'     => 'Jackpot paytable Domino susun',
      'L_DOMINO_QQ'                         => 'Domino-QQ',
      'L_TABLE_DOMINO_QQ'                   => 'Table Domino-QQ',
      'L_CATEGORY_DOMINO_QQ'                => 'Kategori Domino-QQ',
      'L_SEASON_DOMINO_QQ'                  => 'Musim Domino-QQ',
      'L_SEASON_REWARD_DOMINO_QQ'           => 'Hadiah musim Domini-QQ',
      'L_TOURNAMENT_DOMINO_QQ'              => 'Turnamen Domino-QQ',
      'L_JACKPOT_PAYTABLE_DOMINO_QQ'        => 'Jackpot paytable Domino-QQ',
      'L_GAME_SETTING'                      => 'Pengaturan Game',
      'L_STORE'                             => 'Toko',
      'L_BEST_OFFER'                        => 'Penawaran terbaik',
      'L_CHIP_STORE'                        => 'Toko Chip',
      'L_GOLD_STORE'                        => 'Toko Koin',
      'L_GOODS_STORE'                       => 'Toko Barang',
      'L_PAYMENT_STORE'                     => 'Toko Pembayaran',
      'L_REPORT_STORE'                      => 'Laporan Toko',
      'L_NOTIFICATION'                      => 'Pemberitahuan',
      'L_PUSH_NOTIFICATION'                 => 'Pemberitahuan push',
      'L_EMAIL_NOTIFICATION'                => 'Pemberitahuan email',
      'L_FEEDBACK'                          => 'Umpan balik',
      'L_REPORT_ABUSE_PLAYER'               => 'Laporan penyalahgunaan pemain',
      'L_ABUSE_TRANSACTION_REPORT'          => 'Laporan penyalahgunaan transaksi',
      'L_FEEDBACK_GAME'                     => 'Umpan balik game',
      'L_SETTINGS'                          => 'Pengaturan',
      'L_GENERAL_SETTING'                   => 'Pengaturan umum',
      'L_RESELLER'                          => 'Agen',
      'L_LIST_RESELLER'                     => 'Daftar agen',
      'L_RESELLER_TRANSACTION'              => 'Transaksi Agen',
      'L_TRANSACTION_DAY_RESELLER'          => 'Transaksi Harian Agen',
      'L_REQUEST_TRANSACTION'               => 'Transaksi permintaan',
      'L_ADD_TRANSACTION_RESELLER'          => 'Tambah Transaksi',
      'L_REPORT_TRANSACTION'                => 'Laporan Transaksi Pembelian',
      'L_SALES_REPORT_TRANSACTION_RESELLER' => 'Laporan Transaksi Penjualan',
      'L_BALANCE_RESELLER'                  => 'Saldo agen',
      'L_ITEM_STORE_RESELLER'               => 'Toko item agen',
      'L_RESELLER_RANK'                     => 'Rank agen',
      'L_REGISTER_RESELLER'                 => 'Pendaftaran agen',
      'L_VERSION_ASSET_APK'                 => 'Versi asset apk',
      'L_LOG_OUT'                           => 'Keluar',
      'L_MONITORING_TABLE_DOMINO_SUSUN'     => 'Monitor Meja',
      'L_MONITORING_TABLE_DOMINO_QQ'        => 'Monitoring Meja',
      'L_MONITORING_TABLE_BIG_TWO'          => 'Monitor Meja',
      'L_STORE_RESELLER'                    => 'Toko Agen',
      'L_STORE_RESELLER_REPORT'             => 'Laporan Toko Agen'
    ];

    return $array_menu[$menu];
}


//=================================MENU ADMIN===============================//
function translate_MenuContentAdmin($menu){
    
    $array_menuContent = [

        'L_ADMIN'                => 'Admin',
        'L_ROLE_ADMIN'           => 'Peran Admin',
        'L_CREATE_USER_ADMIN'    => 'Buat Admin',
        'L_CREATE_ROLE_ADMIN'    => 'Buat peran admin',
        'L_CHOOSE_ACTION'        => 'Pilih Kategori',
        'Create Admin'           => 'Buat admin',
        'Delete Admin'           => 'Hapus admin',
        'Edit Admin'             => 'Edit admin',
        'Decline Admin'          => 'Tolak admin',
        'Approve Admin'          => 'Terima admin',
        'Change Password Admin'  => 'Ganti katasandi admin',
        'L_CHOOSE_LOG_TYPE'      => 'Pilih Tipe Log',
        'L_PLAYERS_ONLINE'       => 'Pemain online',
        'L_SAVE'                 => 'Simpan',
        'L_SEARCH'               => 'Cari',
        'L_CANCEL'               => 'Batal',
        'L_CREATE_NEW_USER'      => 'Buat pengguna baru',
        'L_SELECT_ALL'           => 'Pilih semua',
        'L_ADMIN_ID'             => 'ID Admin',
        'L_ADMIN_REPORT'         => 'Laporan admin',
        'L_STATUS'               => 'Status',
        'L_ROLE_NAME'            => 'Nama peran',
        'L_USERNAME'             => 'Pengguna Admin',
        "L_FULLNAME"             => "Nama Lengkap",
        "L_ROLE_TYPE"            => "Tipe Peran",
        'L_DATE'                 => 'Tanggal',
        'L_DATE_LOGIN'           => 'Tanggal login',
        'L_TIMESTAMP'            => 'Waktu',
        'L_IP'                   => 'IP',
        'L_DESCRIPTION'          => 'Deskripsi',
        'L_ACTION'               => 'Kategori',
        'L_RESET_PASSWORD'       => 'Reset Katasandi',
        'L_DELETE_DATA'          => 'Hapus data',
        'L_VIEW_EDIT'            => 'Lihat dan Edit',
        'L_QUESTION_DELETE'      => 'Apakah anda yakin akan mengahusnya?',
        'L_YES'                  => 'Ya',
        'L_NO'                   => 'Tidak',
        'L_STATEMENT_DELETE_ALL' => 'Hapus semua data terpilih?',
        'L_QUESTION_DELETE_ALL'  => 'Apakah anda yakin akan menghapus semua data yang dipilih?',
        'L_DESCRIPTION_NULL'     => 'Deskripsi tidak boleh kosong',
        'L_EDIT_USER_ADMIN'      => 'Edit Pengguna Admin',
        'L_EDIT_ROLE_ADMIN'      => 'Edit Peran Admin',
        'L_EDIT_USER_BANK_TRANSACTION'  =>  'Edit Transaksi Bank Pengguna',
        'L_EDIT_GOODS_TRANSACTION'   => 'Edit Transaksi Barang',
        'L_EDIT_ADD_TRANSACTION_PLAYERS' =>  'Edit Tambah Transaksi Pemain',
        'L_EDIT_REGISTER_PLAYER'    =>  'Edit Pemain Terdaftar',
        'L_EDIT_GUEST'           => 'Edit Guest',
        'L_EDIT_REGISTER_PLAYER_ID' =>  'Edit ID Pemain Terdaftar',
        'L_EDIT_PLAYERS_LEVEL'   => 'Edit Level Pemain',
        'L_EDIT_AVATAR_PLAYERS'  => 'Edit Avatar Pemain',
        'L_EDIT_TABLE_GIFT'      => 'Edit Table Gift',
        'L_EDIT_EMOTICON'        => 'Edit Emoticon',
        'L_EDIT_TABLE_ASTA_POKER'=> 'Edit Meja Asta Poker',
        'L_EDIT_CATEGORY_ASTA_POKER'    => 'Edit Kategori Asta Poker',
        'L_EDIT_MONITORING_TABLE_ASTA_POKER' =>  'Edit Monitoring meja Asta Poker',
        'L_EDIT_TABLE_BIG_TWO'  =>  'Edit Meja Big Two',
        'L_EDIT_CATEGORY_BIG_TWO'   =>  'Edit Kategori Big Two',
        'L_EDIT_MONITORING_TABLE_BIG_TWO' =>  'Edit Monitoring meja Big Two',
        'L_EDIT_TABLE_DOMINO_SUSUN' =>  'Edit Meja Domino Susun',
        'L_EDIT_CATEGORY_DOMINO_SUSUN'  =>  'Edit Kategori Domino Susun',
        'L_EDIT_MONITORING_TABLE_DOMINO_SUSUN'  =>  'Edit Monitoring meja Domino Susun',
        'L_EDIT_TABLE_DOMINO_QQ'    =>  'Edit Meja Domino QQ',
        'L_EDIT_CATEGORY_DOMINO_QQ' =>  'Edit Kategori Domino QQ',
        'L_EDIT_MONITORING_TABLE_DOMINO_QQ' =>  'Edit Monitoring meja Domino QQ',
        'L_EDIT_GAME_SETTING'       =>  'Edit Pengaturan Permainan',
        'L_EDIT_CHIP_STORE'         =>  'Edit Toko Chip',
        'L_EDIT_GOLD_STORE'         =>  'Edit Toko Koin',
        'L_EDIT_GOODS_STORE'        =>  'Edit Toko Barang',
        'L_EDIT_PAYMENT_STORE'      =>  'Edit Toko Pembayaran',
        'L_EDIT_GENERAL_SETTING'    =>  'Edit Pengaturan umum',
        'L_EDIT_LIST_RESELLER'      =>  'Edit Daftar Agen',
        'L_EDIT_REQUEST_TRANSACTION_RESELLER' =>    'Edit Permintaan Transaksi Agen',
        'L_EDIT_ADD_TRANSACTION_RESELLER'   =>  'Edit Tambah Transaksi Agen',
        'L_EDIT_ITEM_STORE_RESELLER'    =>  'Edit Toko Item Agen',
        'L_EDIT_RANK_RESELLER'      =>  'Edit Peringkat Agen',
        'L_EDIT_REGISTER_RESELLER'  =>  'Edit Pendaftaran Agen',
        'L_EDIT_VERSION_ASSET_APK'  =>  'Edit Version Asset Apk',

        
        
    ];

    return $array_menuContent[$menu];
}


// //=========================MENU TRANSACTION========================//
function translate_MenuTransaction($menu){

    $array_menuContent = [

        'L_TRANSACTION'           =>  'Transaksi',
        'L_REWARD_TRANSACTION'    =>  'Reward transaksi',
        'L_BANKING_TRANS'   =>  'Transaksi Banking',
        'L_USER_BANK_TRANS' =>  'Transaksi User bank',
        'L_SEARCH'          =>  'Cari',
        'L_ADD_TRANSC'      =>  'Tambah transaksi',
        'L_USER_ID'         =>  'ID Pengguna',
        'L_BALANCE_CHIP'    =>  'Balance chip',
        'L_MIN_TRANSC_CHIP' =>  'Kurang transaction chip',
        'L_TRANSC_POINT'    =>  'Transaksi point',
        'L_BALANCE_POINT'   =>  'Balance point',
        'L_TRANSC_GOLD'     =>  'Transaksi koin',
        'L_BALANCE_GOLD'    =>  'Balance koin',
        'L_MIN_TRANSC_GOLD' =>  'Kurang transaction gold',

        
        //PILIH AKSI
        'L_SEARCH'              =>  'Cari',
        'Choose Time'           =>  'Pilih waktu',
        'Choose Game'           =>  'Pilih Game',
        'L_ALL_GAME'              =>  'Semua Game',
        'Today'                 =>  'Hari ini',
        'L_DAY'                   =>  'Harian',
        'L_WEEK'                  =>  'Mingguan',
        'L_MONTH'                 =>  'Bulanan',
        'L_ALL_TIME'              =>  'Sepanjang waktu',
        'L_GAME'                  =>  'Permainan',
        'L_TIME_STAMP'            =>  'Waktu',
        'L_BANK_TRANSACTION'      =>  'Transaksi Bank',
        'Bank Manual Transfer'  =>  'Transaksi bank manual',
        'L_ID_PLAYER'             =>  'ID pemain',
        'L_ITEM'                  =>  'Item',
        'L_QUANTITY'              =>  'Jumlah',
        'L_PRICE'                 =>  'Harga',
        'buy'                   =>  'membeli',
        'using'                 =>  'menggunakan',
        'at price'              =>  'pada harga',
        'Awarded'               =>  'hadiah',
        'L_TYPE'                  =>  'tipe',
        'L_ITEM_STATUS'           =>  'Status Barang',
        'L_DECLINE'               =>  'Tolak',
        'L_DECLINE_TRANS'   =>  'Tolak transaksi',
        'L_APPROVE_TRANS'   =>  'Terima transaksi',
        'L_QUESTION_DECLINE_TRANS'    =>  'Anda yakin akan menolak transaksi ini ?',
        'L_QUESTION_APPROVE_TRANS'    =>  'Anda yakin akan menerima transaksi ini ?',
        'L_APPROVE'               =>  'Terima',
        'L_PENDING'               =>  'Tunda',
        'L_STATUS_PAYMENT'        =>  'Status pembayaran',
        'L_CONFIRM_REQUEST'       =>  'Konfirmasi permintaan',
        'L_USERNAME'              =>  'Nama pengguna',
        'L_STATUS'                =>  'Status',
        'L_DATE'                  =>  'Tanggal',
        'L_WIN'                   =>  'Menang',
        'L_LOSE'                  =>  'Kalah',
        'L_TURN_OVER'             =>  'Turn Over',
        'L_FEE'                   =>  'Biaya',
        'L_YES'                   =>  'Ya',
        'L_NO'                    =>  'Tidak',
        'pending'               =>  'Tunda',
        'L_DELIVERY_CONFIRM' =>  'Informasi Pengiriman',
        'L_DELIVERY_STATUS'       =>  'Status Pengiriman',
        'L_DETAIL_INFO'           =>  'Detail Info',
        'L_FULL_NAME'             =>  'Nama Lengkap',
        'L_EMAIL'                 =>  'Email',
        'L_PHONE'                 =>  'No. Telp',
        'L_PROVINCE'              =>  'Provinsi',
        'L_ADDRESS'               =>  'Alamat',
        'L_CITY'                  =>  'Kota',
        'L_POSTAL_CODE'           =>  'Kode Pos',
        'L_ON_PROCESS'            =>  'Di Proses',
        'L_REQUEST'               =>  'Permintaan',
        'Pending'               =>  'Tertunda',
        'L_REQ_DELIVERY_STS'  =>  'Wajib diisi status pengiriman',
        'L_IF_THE_ITEM_HAS_BEEN_SENT' =>  'Jika barang telah dikirim',
        'L_DATE_SENT'             =>  'Tanggal Dikirim',
        'L_ITEM_NAME'             =>  'Nama Barang',
        'L_TYPE_OF_SHIPMENT'      =>  'Jenis Pengiriman (Transfer, JNE, TIKI, DLL)',
        'L_SHIPPING_CODE'         =>  'Kode Pengiriman (No Resi / No Transferan)',
        'L_COMPLETED'             =>  'Selesai',
        'Confirmation'          =>  'Konfirmasi',
        'L_JACKPOT'               =>  'Jackpot',
        'L_WIN_LOSE'              =>  'Menang Kalah',
        'L_CASH_DEBIT'            =>  'Debit Tunai',
        'L_CASH_CREDIT'           =>  'Kredit Tunai',
        'L_GOLD_DEBIT'            =>  'Debit Koin',
        'L_GOLD_CREDIT'           =>  'Kredit Koin',
        'L_CHIP_DEBIT'            =>  'Debit Chip',
        'L_CHIP_CREDIT'           =>  'Kredit Chip',
        'L_REWARD_GOLD'           =>  'Reward Koin',
        'L_REWARD_CHIP'           =>  'Reward Chip',
        'L_REWARD_POINT'          =>  'Reward Poin',
        'L_CORRECTION_GOLD'       =>  'Koreksi Koin',
        'L_CORRECTION_CHIP'       =>  'Koreksi Chip',
        'L_CORRECTION_POINT'      =>  'Koreksi Poin', 
        'L_POINT_GET'             =>  'Point Di Dapat',
        'L_POINT_SPEND'           =>  'Poin Di Pakai',
        'L_POINT_EXPIRED'         =>  'Poin Kadaluarsa',
        'L_TRANSC_DAY'       =>  'Transaksi Harian',
        'Detail Information'    =>  'Detail Information',
        'Are you sure want to Decline this Transaction' => 'aaa' ,
        'Are you want to Approve this Transaction?'    => 'cc',
        'L_TRANSPLAYER'         =>  'Transaksi pemain',
        'L_TOTAL_RECORD'        =>  'Total entri adalah',
        'L_TRANSC_CHIP'         =>  'Transaksi chip'
    ];
    return $array_menuContent[$menu];
}

function Translate_menuPlayers($menu){

    $array_menuContent = [

        'L_PLAYERS'                   =>  'Pemain',
        'L_ACTIVE_PLAYERS'            =>  'Pemain aktif',
        'L_REPORT_PLAYER'             =>  'Laporan pemain',
        'L_PLAY_REPORT'               =>  'Laporan permainan',
        'L_PLAYERS_ONLINE'            =>  'Pemain online',
        'L_REGISTERED_PLAYER'         =>  'Pemain terdaftar',
        'L_REGISTERED_PLAYERID'       =>  'ID pemain terdaftar',
        'L_LOG_PLAYERS'               =>  'Catatan Pemain',
        'L_DATA_TOBE_ADDED'           =>  'Jumlah ID yang akan ditambah',
        'L_CHIP_PLAYERS'              =>  'Chip pemain',
        'L_GOLD_PLAYERS'              =>  'Koin pemain',
        'L_POINT_PLAYERS'             =>  'Poin pemain',
        'L_GUEST'                     =>  'Guest',
        'L_CHOOSE_REGISTER_TYPE'      =>  'Pilih tipe pendaftaran',
        'L_ALLGAMES'                  =>  'Semua game',
        'L_CHOOSE_LOG_TYPE'           =>  'Pilih tipe Log',
        'L_CHOOSE_STATUS'             =>  'Pilih status',
        'L_CHOOSE_USER_TYPE'          =>  'Pilih tipe pengguna',
        'L_CHOOSE_ACTION'             =>  'Pilih aksi',
        'L_TOTAL_RECORD'              =>  'Total entri catatan adalah',
        'L_CREATE_GUESTID'            =>  'Buat ID pengguna guest',
        'L_BANK_ACCOUNT'              =>  'Akun Bank',
        'L_COUNTRY'                   =>  'Negara',
        'L_CREATE_PLAYER'             =>  'Buat pemain',
        'L_DELETE_PLAYER'             =>  'Hapus pemain',
        'L_EDIT_PLAYER'               =>  'Edit pemain',
        'L_CHANGE_PASSWORD_PLAYER'    =>  'Ganti katasandi pemain',
        'L_TOTAL_RECORD'              =>  'Total entri catatan adalah',
        'L_PLAYER_ID'                 =>  'ID pemain',
        'L_GUEST_ID'                  =>  'ID Guest',
        'L_DEVICE_ID'                 =>  'ID perangkat',
        'L_ROUND_ID'                  =>  'ID round',
        'L_DETAIL_ROUND_ID'           =>  'Detail ID round',
        'L_ID_PLAYER_ALREADY'         =>  'ID pemain yang sudah ada',
        'L_PLAYER_ID_USED'            =>  'ID pemain terpakai',
        'L_GUEST_ID_USED'             =>  'ID guest terpakai',
        'L_BOT_ID_USED'               =>  'ID bot terpakai',
        'L_PLAYER_ID_DIDNT_USE'       =>  'ID pemain tidak terpakai',
        'L_GUEST_ID_DIDNT_USE'        =>  'ID guest tidak terpakai',
        'L_BOT_ID_DIDNT_USE'          =>  'ID bot tidak terpakai',
        'L_TOTAL_PLAYER_ID'           =>  'Total ID pemain',
        'L_TOTAL_GUEST_ID'            =>  'Total ID guest',
        'L_TOTAL_BOT_ID'              =>  'Total ID bot',
        'L_PLAYERNAME'                =>  'Nama pemain',
        'L_GAME'                      =>  'Game',
        'L_USERTYPE'                  =>  'Tipe pengguna',
        'L_USERNAME'                  =>  'Nama pengguna',
        'L_DESC'                      =>  'Deskripsi',
        'L_PLAYING_GAME'              =>  'Bermain di',
        'L_RANK'                      =>  'Peringkat',
        'L_LEVEL'                     =>  'Level',
        'L_TABLE'                     =>  'Table',
        'L_HAND_CARD'                 =>  'Hand card',
        'L_SEAT'                      =>  'Tempat duduk',
        'L_SIT'                       =>  'duduk',
        'L_BET'                       =>  'Taruhan',
        'L_WIN_LOSE'                  =>  'Menang Kalah',
        'L_CHIP'                      =>  'Chip',
        'L_GOODS'                     =>  'Barang',
        'L_POINT'                     =>  'Poin',
        'L_ACTION'                    =>  'Aksi',
        'L_GOLD_COINS'                =>  'Koin',
        'L_CARD'                      =>  'kartu',
        'L_DOMINO'                    =>  'Domino',
        'L_CARD_TABLE'                =>  'Kartu table',
        'L_DEVICE_TIMER'              =>  'Tanggal kedaluarsa',
        'L_USER'                      =>  'Terpakai',
        'L_NON_USED'                  =>  'Tidak terpakai',
        'L_FROM'                      =>  'dari',
        'L_DEBIT'                     =>  'Debit',
        'L_CREDIT'                    =>  'Kredit',
        'L_TOTAL'                     =>  'Total',
        'L_PLAYING_GAMES'             =>  'Kategori game',
        'L_TABLE_NAME'                =>  'Nama table',
        'L_TIMESTAMP'                 =>  'Waktu dibuat',
        'L_STATUS'                    =>  'Status',
        'L_DATE_CREATED'              =>  'Waktu dibuat',
        'L_REGISTER_FORM'             =>  'Form pendaftaran',
        'L_IP'                        =>  'Alamat IP',
        'L_PLAYER'                    =>  'Pemain',
        'L_GUEST'                     =>  'Guest',
        'L_APPROVE'                   =>  'Setuju',
        'L_BANNED'                    =>  'Dilarang',
        'L_PROBLEM'                   =>  'Bermasalah',
        'L_SAVE'                      =>  'Simpan',
        'L_CANCEL'                    =>  'Cancel',
        'L_PLAYERS_LEVEL'             =>  'Level pemain',
        'L_CREATE_PLAYER_LEVEL'       =>  'Buat level pemain',
        'L_LEVEL'                     =>  'Maks Level',
        'L_EXPERIENCE'                =>  'Maks Pengalaman',
        'L_PLAYER_RANK'               =>  'Peringkat pemain',
        'L_CREATE_RANK_PLAYER'        =>  'Buat peringkat pemain',
        'L_SAVE_AVATAR'               =>  'Simpan avatar',
        'L_EDIT_AVATAR'               =>  'Ubah avatar',
        'L_EDIT'                      =>  'Edit',
        'L_MAIN'                      =>  'Utama',
        'L_CONFIRMATION'              =>  'Konfirmasi',
        'L_LOBBY'                     =>  'Lobi',
        'L_CREATE_NEW_AVATAR'         =>  'Buat avatar baru',
        'L_AVATAR_PLAYER'             =>  'Avatar pemain',
        'L_CARD'                    =>  'Kartu',
        'L_CREATE_PLAYER'           =>  'Buat pemain',
        'L_DELETE_PLAYER'           =>  'Hapus pemain',
        'L_EDIT_PLAYER'             =>  'Edit pemain',
        'L_CHIP_PLAYERS'            =>  'Chip Pemain',
        'L_BET'                     =>  'Taruhan',
        'L_COUNT_CARD'              =>  'Jumlah Kartu',
        'L_CARD_HAND'               =>  'Kartu Ditangan',
        'L_CARD_OUT'                =>  'Kartu dikeluarkan',
        'L_NEW_ROUND'               =>  'Ronde Baru',
        'L_DIVIDED_CARD'            =>  'Kartu Di Bagikan',
        'L_WIN'                     =>  'Menang',
        'L_LOSE'                    =>  'Kalah',
        'L_DRAW'                    =>  'Draw',
        'L_BET_CALL'                =>  'Bertaruh / Ikut',
        'L_CHECK'                   =>  "Cek",
        'L_RAISE'                   =>  'Tambah',
        'L_FOLD'                    =>  'Tutup',
        'L_PLAY'                    =>  'Play',
        'L_PASS'                    =>  'Lewat',
        'L_BIG_BLIND'               =>  'Big Blind',
        'L_SMALL_BLIND'             =>  'Small Blind',
        'L_ALL_IN'                  =>  'All In',
        'L_REMAINING_TYPE'          =>  'Remaining Type',
        'L_LOGIN_PLAYER'            =>  'Pemain login',
        'L_APPROVE_ACCOUNT_PLAYER'  =>  'Akun pemain disetujui',
        'L_BANNED_ACCOUNT_PLAYER'   =>  'Akun pemain dilarang',
        'L_PROBLEM_ACCOUNT_PLAYER'  =>  'Akun pemain bermasalah',
        'L_UPGRADE_ACCOUNT'         =>  'Upgrade akun',
        'L_CARD_TYPE'               =>  'Type Kartu',
        'L_CARD_TABLE'              =>  'Kartu Meja',
        'L_DEALER'                  =>  'Dealer',
        'L_HIGH_CARD'               =>  'High Card',
        'L_PAIR'                    =>  'Pair',
        'L_2_PAIR'                  =>  'Two Pair',
        'L_3_KIND'                  =>  'Three Of Kind',
        'L_4_KIND'                  =>  'Four Of Kind',
        'L_FULL_HOUSE'              =>  'Full House',
        'L_STRAIGHT'                =>  'Straight',
        'L_FLUSH'                   =>  'Flush',
        'L_STRAIGHT_FLUSH'          =>  'Straight Flush',
        'L_ROYAL_FLUSH'             =>  'Royal Flush',
        'L_CARD_VALUE'              =>  'Nilai Kartu',
        'L_CHANGE_PLAYER_STATUS'    =>  'Ganti status pemain',
        'L_USER_ID'                 =>  'ID Pengguna',
        'L_DATE_TIME'               =>  'Waktu',
        'L_PROFILE'                 =>  'Profil pemain',
        'L_REGISTER_IN'             =>  'Register in',
        'L_EMAIL'                   =>  'Email',
        'L_COUNTRY'                 =>  'Negara',
        'L_GOLD'                    =>  'Koin',
        'L_CHIP'                    =>  'Chip',
        'L_POINT'                   =>  'Poin',
        'L_DEVICE_ID'               =>  'ID Perangkat',
        'L_DEVICE_NAME'             =>  'Nama perangkat',
        'L_DATE_IN'                 =>  'Tanggal masuk',
        'L_SEARCH'                  =>  'Cari',
        'L_USED'                    =>  'Terpakai',
        'L_NON_USED'                =>  'Tidak terpakai',
        'L_EXIT'                    =>  'Keluar',
        'L_USERNAME'                =>  'Nama pengguna'


    ];
    return $array_menuContent[$menu];
}


function TranslateMenuItem($menu){

    $array_menuContent = [

        'L_ITEM'              =>  'Item',
        'L_TABLE_GIFT'        =>  'Table gift',
        'L_CREATE_NEW_GIFT'   =>  'Buat gift baru',
        'L_REPORT_GIFT'       =>  'Laporan gift',
        'L_SELECT_ALL'        =>  'Pilih semua',
        'L_IMAGE'             =>  'Gambar',
        'L_TITLE'             =>  'Judul',
        'L_PRICE'             =>  'Harga',
        'L_CATEGORY'          =>  'Kategori',
        'L_STATUS'            =>  'Status',
        'L_MAIN_IMAGE'        =>  'Gambar utama',
        'L_SAVE_GIFT'         =>  'Simpan gift',
        'L_SAVE'              =>  'Simpan',
        'L_CANCEL'            =>  'Batal',
        'L_EDIT_GIFT'         =>  'Ubah gift',
        'L_CREATE_GIFT_STORE' =>  'Buat toko gift',
        'L_DELETE_DATA'        =>  'Hapus data',
        'L_QUESTION_DELETE_IT' => 'Apakah anda yakin akan menghapusnya?',
        'L_YES'               =>  'Ya',
        'L_NO'                =>  'Tidak',
        'L_DELETE_ALL_SELECTED_DATA'       => 'Hapus semua data terpilih',
        'L_ARE_U_SURE'        =>  'Apakah anda yakin akan menghapus semua data yang dipilih?',
        'L_CHOOSE_GAME'       =>  'Pilih game',
        'L_USERNAME'          =>  'Nama pengguna',
        'L_ACTION_GAME'       =>  'Aksi game',
        'L_DATE'              =>  'Tanggal',
        'L_DESCRIPTION'       =>  'Deskripsi',
        'L_EMOTICON'          =>  'Emoticon',
        'L_CREATE_NEW_EMOTICON'=> 'Buat emotikon baru',
        'L_CREATE_EMOTICON'   =>  'Buat emotikon',
        'L_EDIT'              =>  'Ubah',
        'L_GIFT_ID'           =>  'ID Gift',
        'L_EMOTICON_ID'       =>  'Emotikon ID',
        'L_SEE_DETAIL_IMAGE'  =>  'Lihat Detail Gambar / Gif',
        'L_DETAIL_INFO'       =>  'preview gambar',
        'L_DETAIL_IMAGE'      =>  'Detail Gambar'
    ];

    return $array_menuContent[$menu];

}


function TranslateMenuGame($menu){

    $array_menuContent = [
        'L_TABLE'                => 'Table',
        'L_TABLE_PLAYER'         => 'Table pemain',
        'L_CHANGE_TITLE'         => 'Ganti  nama',
        'L_CREATE_NEW_TABLE'     => 'Buat table baru',
        'L_TABLE_NAME'           => 'Nama table',
        'L_GROUP'                => 'Grup',
        'L_MAX_PLAYER'           => 'Pemain maks',
        'L_SMALL_BLIND'          => 'Small blind',
        'L_BIG_BLIND'            => 'Big blind',
        'L_JACKPOT'              => 'Jackpot',
        'L_MIN_BUY'              => 'Minimal beli',
        'L_MAX_BUY'              => 'Maksimal beli',
        'L_TIMER'                => 'Timer',
        'L_ACTION'               => 'Aksi',
        'L_CREATE_TABLE'         => 'Buat table',
        'L_SELECT_CATEGORY'      => 'Pilih kategori',
        'L_SAVE'                 => 'Simpan',
        'L_CANCEL'               => 'Batal',
        'L_DELETE_DATA'          => 'Hapus data',
        'L_ARE_YOU_SURE'         => 'Apakah anda yakin ingin menghapusnya?',
        'L_YES'                  => 'Ya',
        'L_NO'                   => 'Tidak',
        'L_CATEGORY'             => 'Kategori',
        'L_ASTA_POKER_TABLE'     => 'Meja Asta Poker',
        'L_TITLE'                => 'Judul',
        'L_CREATE_CATEGORY'      => 'Buat kategori',
        'L_ASTA_BIG_TWO_TABLE'   => 'Meja Asta Big Two',
        'L_ASTA_DOMINO_QQ_TABLE' => 'Meja Asta Domino QQ',
        'L_ASTA_DOMINO_SUSUN_TABLE' =>  'Meja Asta Domino susun',
        'L_CREATE_NEW_TABLE'     => 'Buat table baru',
        'L_TURN'                 => 'Giliran',
        'L_TOTAL_BET'            => 'Total Taruhan',
        'L_STAKE'                => 'Stake',
        'L_GAME_STATE'           => 'Status permainan',
        'L_ROOM_NAME'            => 'Nama room',
        'L_NAME'                 => 'Nama',
        'L_LANGUAGE'             => 'Bahasa',
        'L_INDONESIA'            => 'Indonesia',
        'L_ENGLISH'              => 'Inggris',
        'L_UPLOAD_FILE_LANGUAGE' => 'Unggah File Bahasa',
        'L_PLAY_TIME'            => 'Waktu Bermain',
        'L_SEAT'                 => 'Kursi',
        'L_USERNAME_PLAYER'      => 'Nama Pengguna Pemain',
        'L_SEE_DETAIL'           => 'Lihat Detail',
        'L_ONLINE'               => 'Daring',
        'L_PLAYERS'              => 'Pemain',
        'L_REFRESH'              => 'Refresh',
        'L_AUTO_REFRESH'         => 'Refresh Otomatis',
        'L_NOVICE'               => 'Pemula',
        'L_INTERMEDIATE'         => 'Menengah',
        'L_PRO'                  => 'Ahli',
        'L_SEE'                  => 'Lihat'  

    ];

    return $array_menuContent[$menu];
}


function TranslateMenuToko($menu){

    $array_menuContent = [

        'L_BEST_OFFER'        =>  'Penawaran terbaik',
        'L_STORE'             =>  'Toko',
        'L_IMAGE'             =>  'Gambar',
        'L_TITLE'             =>  'Judul',
        'L_RATE'              =>  'Rate',
        'L_CATEGORY'          =>  'Kategori',
        'L_PRICE_CASH'        =>  'Harga cash',
        'L_AS_LONG'           =>  'As long',
        'L_PAY_TRANSACTION'   =>  'Transaksi pembayaran',
        'L_ACTION'            =>  'Aksi',
        'L_CREATE_BEST_OFFER' =>  'Buat penawaran terbaik',
        'L_DAY'               =>  'Hari',
        'L_PAYMENT_METHODE'   =>  'Metode pembayaran',
        'L_TRANSACTION_TYPE'  =>  'Tipe transaksi',
        'L_BANK_TRANSFER'     =>  'Transfer Bank',
        'L_INTERNET_BANKING'  =>  'Imternet banking',
        'L_CASH_DIGITAL'      =>  'Uang digital',
        'L_MANUAL_TRANSFER'   =>  'Transfer manual',
        'L_SHOP'              =>  'Toko',
        'L_CREDIT_CARD'       =>  'Kartu kredit',
        'L_STORE'             =>  'Toko',
        'L_CHIP_STORE'        =>  'Toko chip',
        'L_GOODS_STORE'       =>  'Toko barang',
        'L_REPORT_STORE'      =>  'Laporan toko',
        'L_PAYMENT_STORE'     =>  'Toko pembayaran',
        'L_CREATE_NEW_CHIP_STORE'   =>  'Buat Toko chip baru',
        'L_CREATE_NEW_GOODS_STORE'  =>  'Buat Toko barang baru',
        'L_CREATE_NEW_PAYMENT_STORE'=>  'Buat Toko pembayaran baru',
        'L_ORDER'             =>  'No urut',
        'L_CHIP_AWARDED'      =>  'Chip yang didapat',
        'L_GOLD_AWARDED'      =>  'Koin yang didapat',
        'L_GOLD_COST'         =>  'Harga koin',
        'L_ACTIVE'            =>  'Aktif',
        'L_MAIN_IMAGE'       =>  'Gambar utama',
        'L_SAVE_IMAGE'        =>  'Simpan gambar',
        'L_EDIT'              =>  'Edit',
        'L_CREATE_NEW_GOLD_STORE'   =>  'Buat toko koin baru',
        'L_ITEM_TYPE'         =>  'Tipe item',
        'L_PAY_TRANSACTION'   =>  'Transaksi pembayaran',
        'L_PRICE_POINT'       =>  'Price poin',
        'L_CHOOSE_TYPE_DATE'  =>  'Pilih tipe tanggal',
        'L_DATEAPPROVE_DECLINE'  => 'Tanggal disetujui dan ditolak',
        'L_DATE_REQUEST'      =>  'Tanggal Pembelian',
        'L_ITEM_AWARDED'      =>  'Item diberikan',
        'L_BONUS_ITEM'        =>  'Bonus Item',
        'L_STATUS_INFORMATION'=> 'Informasi Status',
        'L_PLAYER_ID'         =>  'ID Pemain',
        'L_USERNAME'          =>  'Nama Pengguna',
        'L_ITEM'              =>  'Item',
        'L_QUANTITY'          =>  'Jumlah',
        'L_DESCRIPTION'       =>  'Deskripsi',
        'L_PRICE'             =>  'Harga',
        'L_CONFIRMATION'      =>  'Konfirmasi',
        'L_STATUS'            =>  'Status',
        'L_DATE_SENT'         =>  'Tanggal Pengiriman',
        'L_THE_DATE_THE_ITEM_WAS_RECEIVED'    =>  'Tanggal Diterima',
        'L_TYPE_OF_DELIVERY'  =>  'Jenis Pengiriman',
        'L_CODE_RECEIPT'      =>  'Kode pengiriman (no resi / no transferan)',
        'L_SUCCESS'           =>  'Sukses',
        'L_DECLINE'           =>  'Ditolak',
        'L_RECEIVED_AND_SENT' =>  'Terima & Dikirm',
        'L_PAYMENT_TYPE'      =>  'Tipe Pembayaran',
        'L_ITEM_BONUS'        =>  'Bonus item',
        'L_ITEM_BONUS_IMAGE'  =>  'Gambar item bonus',
        'L_ITEM_BONUS_GET'    =>  'Item bonus yang didapat',
        'L_GOOGLE_KEY'        =>  'Google key',
<<<<<<< HEAD

=======
>>>>>>> 4063a539c261fe0fc5b5c7d24fff752000a50249
    ];

    return $array_menuContent[$menu];
}


function TranslateMenuFeedback($menu){

    $array_menuContent = [

        'Feedback'                  =>  'Umpan balik',
        'Abuse Transaction Report'  =>  'Laporan penyalahgunaan Transaksi',
        'Report Abuse Player'       =>  'Laporan penyalahgunaan pemain',
        'Image Proof'               =>  'Bukti gambar',
        'Rating'                    =>  'Penilaian',
        'Message'                   =>  'Pesan',
        'User ID sender'            =>  'ID pengirim',
        'Username sender'           =>  'Nama pengirim',
        'Reported User ID'          =>  'ID pengguna yang dilaporkan',
        'Reported User'             =>  'Pengguna yang dilaporkan',
        'Reason'                    =>  'Alasan',


    
    ];
    return $array_menuContent[$menu];
}

function TranslateGeneralSettings($menu){

    $array_menuContent = [

        'System settings'           =>  'Pengaturan setting',
        'Maintenance'               =>  'Pemeliharaan',
        'Point expired'             =>  'Masa aktif pemain',
        'Award Signup'              =>  'Hadiah sign up',
        'Award Signup Guest'        =>  'Hadiah sign up sebagai guest',
        'Award Daily Chips'         =>  'Hadiah chip harian',
        'Award Daily Chips Guest'   =>  'Hadiah chip harian guest',
        'Award Daily Days'          =>  'Hadiah harian',
        'Award Daily Multiply'      =>  'Hadiah berlipat harian',
        'Bank Settings'             =>  'Pengaturan Bank',
        'Info Settings'             =>  'Pengaturan info',
        'About'                     =>  'Tentang',
        'Edit About'                =>  'Edit Tentang',
        'CS & Legal Settings'       =>  'CS dan pengaturan legal',
        'Edit privacy & policy'     =>  'Ubah Kebijakan dan privasi',
        'Edit Term of Service'      =>  'Ubah Ketentuan pelayanan',
        'days'                      =>  'Hari',
        'Edit Asta Poker'           =>  'Ubah Asta Poker',
        'Edit Big Two'              =>  'Ubah Big two',
        'Edit Domino QQ'            =>  'Ubah Domino QQ',
        'Edit Domino Susun'         =>  'Ubah Domino susun',
        

    ];
    return $array_menuContent[$menu];
}

function TranslateReseller($menu){

    $array_menuContent = [

        'L_RESELLER_ID'            => 'ID agen',
        'Phone'                  => 'Telefon',
        'Saldo gold'             => 'Saldo koin',
        'Report Transaction'     => 'Laporan transaksi',
        'Bonus Item'             => 'Bonus item',
        'Balance'                => 'Saldo',
        'Gold Group'             => 'Grup koin',
        'Create Reseller Rank'   => 'Buat peringkat agen',
        'Password'               => 'Katasandi',
        'Identity Card'          => 'Kartu identitas',
        'Access denied'          => 'Akses ditolak',
        'You cant access'        => 'Anda tidak dapat mengakses',
        'Create new asset'       => 'Buat asset baru',
        'Link'                   => 'Link',
        'Version'                => 'Versi',
        'Edit Asset'             => 'Edit asset',
        'Choose a file'          => 'pilih file',
        'Create new reseller'    => 'buat agen baru',
        'Select All'             => 'Pilih semua',
        'L_WEEKLY'               => 'Mingguan',
        'L_MONTHLY'              => 'Bulanan',
        'L_YEARLY'               => 'Tahunan',
        'Create new'             => 'Buat baru',
        'Username / Reseller ID' => 'Nama Agent / ID Agen',
        'Gold'                   => 'Koin',
        'Reason Gold'   => 'Alasan Koin dikurangi',
        'Date Created'           => 'Tanggal',
        'Buy Gold'               => 'Beli Koin',
        'Buy Amount'             => 'Jumlah Pembelian',
        'Sell Gold'              => 'Jual Koin',
        'Reward Gold'            => 'Reward Koin',
        'Correction Gold'        => 'Koreksi Koin',
        'L_USERNAME_RESELLER'    => 'Nama Reseller',
        'L_RESELLER_ID'            => 'ID Agen',
        'Add Transaction Gold'   => 'Tambah Transaksi Koin',
        'L_ORDER_ID'             => 'Order ID',
        'L_DATE_APPROVE'         => 'Tgl & waktu di setujui',
        'L_ITEM_NAME'            => 'Nama Item',
        'L_QUANTITY'             => 'Jumlah Item',
        'L_PRICE_ITEM'           => 'Harga Barang',
        'L_BONUS_ITEM'           => 'Bonus Item',
        'L_DATE_REQUEST'         => 'Tanggal Pembelian',
        'L_DATE_APPROVE_DECLINE' => 'Tanggal di setujui atau di tolak',
        'L_CONFIRMATION_REQUEST' => 'Konfirmasi Pemintaan',
        'L_INFORMATION_DETAIL'   => 'Informasi Detail',
        'L_DATE_SELL'            => 'Tanggal Penjualan',
        'L_PLAYER_ID'            => 'ID Pemain',
        'L_USERNAME_PLAYER'      => 'Nama Pemain',
        'L_STATUS'               => 'Status',
        'L_TOTAL_GOLD'           => 'Total Koin',
        'L_USERNAME'             => 'Nama Reseller',
        'L_ACTION'               => 'Aksi',
        'L_STATUS_TRANSACTION'   => 'Status Transaksi',
        'L_TIMESTAMP'            => 'TimeStamp',
        'L_ORDER_TRANSACTION'    => 'ID Order / Transaksi',
        'L_DATE_BUY_SELL'        => 'Tanggal Pembelian / Penjualan'

    
    ];
    return $array_menuContent[$menu];
}


function ConfigTextTranslate($menu){

    $array_menuContent = [

        "L_DENIED"       => "Tutup",
        "L_ACCESS"       => "Akses",
        "L_EDIT"         => "Edit",
        "L_LOGIN"        => "Masuk",
        "L_LOGOUT"       => "Keluar",
        "L_PENDING"      => "Tunda",
        "L_SUCCESS"      => "Sukses",
        "L_FAILED"       => "Gagal",
        "L_BET"          => "Taruhan",
        "L_WIN"          => "Menang",
        "L_LOSE"         => "Kalah",
        "L_DRAW"         => "Seri",
        "L_TRANSFER_IN"  => "Transfer masuk",
        "L_TRANSFER_OUT" => "Transfer Keluar",
        "L_FREE"         => "Gratis",
        "L_BONUS"        => "Bonus",
        "L_GIFT"         => "Hadiah",
        "L_REWARD"       => "Penghargaan",
        "L_BUY"          => "Beli",
        "L_PLAYER"       => "Pemain",
        "L_GUEST"        => "Guest",
        "L_BOT"          => "Bot",
        "L_DISABLED"     => "Non aktif",
        "L_ENABLED"      => "Aktif",
        "L_CHIP"         => "Chip",
        "L_GOLD"         => "Koin",
        "L_GOOD"         => "Barang",
        "L_FOOD"         => "Makanan",
        "L_DRINK"        => "Minuman",
        "L_ITEM"         => "Item",
        "L_ACTION"       => "Aksi",
        "L_CORRECTION"   => "Koreksi",
        "L_ADJUST"       => "Penyesuaian",
        "Lose"           => "Kalah",
        "Win"            => "Menang",
        // "1"                                                 =>  "1",
        "" => ""

    ];
    return $array_menuContent[$menu];
};

function alertTranslate($menu){

    $array_menuContent = [

        "insert data successful"                                        =>  "memasukan data berhasil",
        'L_INSERT_SUCCESSFULL'                                          =>  "Memasukan data berhasil",
        "Successful image"                                              =>  "Gambar berhasil",
        "Failed"                                                        =>  "Gagal",
        "end date can't be less than start date"                        =>  "Tanggal akhir tidak boleh sebelum tanggal mulai",
        "balance cannot be reduced"                                     =>  "balance tidak dapat dikurangi",
        "balance cannot be reduced, please enter the appropriate amount"=>  "balance tidak dapat dikurangi, silahkan masukan nominal yang sesuai",
        "Successful update"                                             =>  "Update sukses",
        "Name can't be NULL"                                            =>  "Nama tidak bisa menjadi NULL",
        "File extensions are not allowed, you must use .jpg"            =>  "Ekstensi file tidak diperbolehkan, harus menggunakan .jpg",
        "Update Image Successfull"                                      =>  "Update gambar sukses",
        "format must be jpg and pictorial"                              =>  "Format gambar harus jpg",
        "Data deleted"                                                  =>  "Data terhapus",
        "Something wrong"                                               =>  "Ada sesuatu yang salah",
        "Min Date And Max Date Must be Filled In"                       =>  "Minimum tanggal dan maksimal tanggal harus di isi",
        "Data Added"                                                    =>  "Data ditambahkan",
        "Max Buy can't be under Min Buy"                                =>  "Max buy tidak bisa dibawah Min buy",
        "Size Image it's too Big"                                       =>  "Ukuran gambar terlalu besar",
        "Image must be in png"                                          =>  "Gambar harus berformat png",
        "Price can't be NULL"                                           =>  "Harga tidak bisa NULL",
        "File extensions are not allowed"                               =>  "Ekstensi file tidak diperbolehkan",
        "Data Updated"                                                  =>  "Data diperbarui",
        "Update can't be process"                                       =>  "Data tidak dapat diproses",
        "Category can't be NULL"                                        =>  "Kategori tidak dapat NULL",
        "Your image source size height is more than 319 px and width is more than 384" => "Tinggi ukuran sumber gambar Anda lebih dari 319 px dan lebar lebih dari 384",
        "format must be png and pictorial"                              =>  "Format gambar harus png",
        "ID must be fill"                                               =>  "ID harus diisi",
        "Username or Password are wrong!!"                              =>  "Username dan katasandi salah!!",
        "You are already Log Out"                                       =>  "Kamu sudah keluar",
        "Update status successfull"                                     =>  "Memperbarui status berhasil",
        "Input Data successfull with "                                  =>  "Input data berhasil dengan",
        "Number of inputs filled in player ID can't be NULL"            =>  "Jumlah input yang diisi ID pemain tidak boleh NULL",
        "You must to Choose Status"                                     =>  "Kamu harus memilih status",
        "Data input successfull"                                        =>  "Data berhasil di input", 
        "L_RESET_PASSWORD_SUCCESS"                                   =>  "Setel ulang password berhasil",
        "L_PASSWORD_NULL"                                              =>  "Katasandi NULL",
        "REGISTER SUCCESSFULL"                                          =>  "Pendaftaran sukses",
        "Approved Successful"                                           =>  "BERHASIL DISETUJUI",
        "Declined Successful"                                           =>  "DITOLAK BERHASIL",
        "File size too large"                                           =>  "Ukuran file terlalu besar",
        "Receiving request Transaction has been successful"             =>  "Menerima permintaan transaksi telah berhasil",
        "Reject request Transaction has been successful"                =>  "Menolak permintaan transaksi telah berhasil",
        "Role Name is Null"                                             =>  "Nama peran NULL",
        "your Big blind can't be under Minbuy divided 10 "              =>  "Big blind Anda tidak dapat berada di bawah Minbuy dibagi 10",
        "your Small Blind can't be under Big Blind divided 2 "          =>  "Small blind Anda tidak dapat berada di bawah Big Blind dibagi 2",
        "Min buy table can't be under Min Buy room"                     =>  "Table min buy tidak boleh dibawah room min buy",
        "Max buy table can't be up to max buy room"                     =>  "Table max buy tidak bisa sampai dengan room max buy",
        "Min Buy can't be under Stake multiplied by 3 multiplied 13 or under "  =>  "Min Buy tidak bisa di bawah stake yang dikalikan dengan 3 kali 13 atau di bawah",
        "Max buy can't be under min buy"                                =>  "Max buy tidak bisa dibawah min buy",
        "Min buy can't be under max buy"                                =>  "Min buy tidak bisa dibawah max buy",
        "Max buy can't be up to max buy room"                           =>  "Max buy tidak bisa sampai room max buy",
        "Max buy can't be under Stake multiplied by 10 or under "       =>  "Max buy tidak bisa dibawah stake dikalikan 10 atau dibawahnya",
        "Max buy can't be under Min buy multiplied by 4 or under "      =>  "Max buy tidak bisa dibawah Min buy dikalikan 4 atau dibawahnya",
        "Min buy can't be under stake multiplied by 10 or under"        =>  "Min buy tidak bisa dibawah stake dikalikan 10 atau dibawahnya",
        "Max buy can't be under Min Buy multiplied by 2 or under"       =>  "Max buy tidak bisa dibawah Min buy dikalikan 2 atau dibawahnya",
        "your Small Blind can't be under Big Blind divided 2 or under"  =>  "Small blind mu tidak bisa dibawah Big blind dibagi 2 atau dibawahnya",
        "Max buy can't be under Stake multiplied by 2 or under"         =>  "Max buy tidak bisa dibawah Stake dikalikan 2 atau dibawahnya",
        "Min buy can't be under to min buy room "                       =>  "Min buy tidak bisa dibawah room min buy",
        "Max Buy can't be under Stake multiplied by 4 or under "        =>  "Max buy tidak bisa dibawah stake dikali 4 atau dibawahnya",
        "Max Buy table can't be Up to Max Buy room"                     =>  "table max buy tidak bisa diatas room max buy",
        "You didn't allow to delete your account"                       =>  "Kamu tidak diperbolehkan menghapus akunmu",
        "Data saved"                                                    =>  "Data tersimpan!",
        "Data added"                                                    =>  "Data berhasil di tambahkan",
        "Operator Still use this role, wait until role didnott use"     =>  "Operator masih menggunakan peran ini, tunggu peran ini tidak dipakai",
        "For Type Adjust number didnot allowed negative"                =>  "Untuk tipe penyesuaian nomor tidak boleh negatif",
        "For type Bonus or Free number not allowed negative number"     =>  "Untuk tipe Bonus atau Gratis nomornya tidak diperbolehkan negatif",
        "User ID"                                                       =>  "ID Pengguna",
        "Balance Chip"                                                  =>  "Saldo chip",
        "Balance Point"                                                 =>  "Saldo Point",
        "Balance Gold"                                                  =>  "Saldo Koin",
        "Transaction Chip"                                              =>  "Transaksi Chip",
        "Transaction Gold"                                              =>  "Transaksi Koin",
        "Transaction Point"                                             =>  "Transaksi Poin",
        "L_PASSWORD_FAILED"                                             =>  "Password tidak cocok silahkan coba lagi",
        "L_LOGOUT_CHANGE_PASSWORD"                                      =>  "Password anda telah di ganti",
        "Update image successfull"                                      =>  "Update gambar berhasil",
        'L_HEIGHT_IMAGE'                                                =>  "Tinggi gambar tidak boleh kurang atau lebih dari {1}"
    ];
    return $array_menuContent[$menu];
};

function Translateaction_id($menu){

    $array_menuContent  =   [
        
        "Change Password Admin"     =>      "Ubah password admin",
        "Edit Admin"                =>      "Ubah admin",
        "Create Admin"              =>      "Buat admin",
        "Delete Admin"              =>      "Hapus admin",
        "Approve Admin"             =>      "Setujui admin",
        "Decline Admin"             =>      "Tolak admin",
        "Log In Admin"              =>      "Admin login",
        "Log Out Admin"             =>      "Admin logout",
        "Buy chip with gold"        =>      "Beli chip dengan koin",
        "Daily Award"               =>      "Hadiah harian",
        "Bot Join Table"            =>      "Bot join Table",
        "Join Game"                 =>      "Bergabung dengan game",
        "Sitout Game"               =>      "Sitout Game",
        "Register User"             =>      "Daftar Pengguna",
        "Give Gold"                 =>      "Beri Koin",
        "Buy Gold"                  =>      "Beli Koin",
        "Skilled Bonus Gold"        =>      "Bonus Koin Ahli",
        "Newbie Bonus Gold"         =>      "Bonus Koin Pemula",
        "Create Player"             =>      "Buat Pemain",
        "Delete Player"             =>      "Hapus Pemain",
        "Edit Player"               =>      "Ubah Pemain",
        "Change Password Player"    =>      "Ubah Password Pemain",
        "Login Player"              =>      "Pemain login",
        "Approve Account Player"    =>      "Akun pemain disetujui",
        "Banned Account Player"     =>      "Akun pemain terlarang",
        "Problem Account Player"    =>      "Akun pemain bermasalah",
        "Upgrade Account"           =>      "Tingkatkan akun",
        "L_EDIT_CHIP_STORE"         =>      "L_EDIT_CHIP_STOR",
        'L_EDIT_GOODS_STORE'        =>      'Edit Toko Barang',
        "L_EDIT_PLAYER"             =>      'Edit pemain',
        'L_LOGIN_PLAYER'            =>      'Pemain login',
        'L_UPGRADE_ACCOUNT'         =>      'Upgrade akun',
        'L_PROBLEM_ACCOUNT_PLAYER'  =>      'Akun pemain bermasalah',
        'L_BANNED_ACCOUNT_PLAYER'   =>      'Akun pemain dilarang',
        

    ];
    return $array_menuContent[$menu];
};

function TranslateTransactionHist($menu){

    $array_menuContent = [
        
        "success"                   =>  "sukses",
        "pending"                   =>  "tunda",
        "Decline"                   =>  "ditolak",
        "Approve"                   =>  "disetujui",
        "GPA.3355-0553-1720-23050"  =>  "GPA.3355-0553-1720-23050",
        "nothing"                   =>  "tidak ada",
        "tidak jelas"               =>  "tidak jelas",
    

    ];
    return $array_menuContent[$menu];
};

function TranslateTransaksiAgen($menu){

    $array_menuContent = [
    
        "Purchase Date"   =>  "Tgl & Waktu pembelian",
        "User ID"         =>  "ID Pengguna",
        "ID Order"        =>  "ID Agen",
        "Transaction Type"=>  "Tipe transaksi"
    ];
    return $array_menuContent[$menu];
};


function TranslateVersionAsetApk($menu)
{
    $array_menuContent = [
        
        "L_IMAGE"   =>  "Gambar",
        "L_AUDIO"   =>  "Suara",
        "L_SCENE"   =>  "Scene"
           
    ];
    return $array_menuContent[$menu];
}


function TranslatePlaceholdertxt($placeholder) {
    $array_menuContent = [
        
        "L_PASSWORD"             => "Kata Sandi",
        "L_PASSWORD_WANT_CHANGE" => "Kata Sandi yang mau di ganti",
        "L_PASSWORD_SELF"        => "Massukan Kata Sandi yang sedang login",
        "L_CHOOSE_ROLE_ADMIN"    => "Pilih tipe peran",
        "L_CHOOSE_TYPE"          => "Pilih tipe",
        "L_MONTHLY"              => "Bulanan",
        "L_WEEKLY"               => "Mingguan",
    ];
    return $array_menuContent[$placeholder];
}



function TranslateChoices($menu) {
    $array_menuContent = [

        "L_CHOOSE_TIMER"    =>  "Pilih waktu",
        "L_CHOOSE_CATEGORY" =>  "Pilih kategori",
        "L_CHOOSE_SEAT"     =>  "Maksimal Pemain"
    ];
    return $array_menuContent[$menu];
}

function TranslateColumnName($menu) {
    $array_menuContent = [

        "L_FULLNAME"    =>  "Nama Lengkap",
        "L_ROLETYPE" =>  "Tipe Peran",
        ""
    ];
    return $array_menuContent[$menu];
}

function TranslateLogDesc($menu) {
    $array_menuContent = [
        "L_LOG_CREATE"          =>  "Menambahkan data di menu",
        "L_LOG_EDIT"            =>  "Edit",
        "L_LOG_EDIT_PASSWORD"   =>  "Edit kata sandi  dengan nama pengguna",
        "L_LOG_DELETE"          =>  "Hapus"
        // "L_PASSWORD"      =>  "Edit kata sandi di menu Pengguna Admin dengan Nama Pengguna {1}"
    ];
    return $array_menuContent[$menu];
}

function TranslateGameSetting($menu)
{
    $array_menuContent = [
        "bet_fee"    =>  "Pajak Taruhan",
        "bet_point"  =>  "Point Trauhan",
        "countdown"  =>  "Hitungan Mundur",
        "jp_fee"     =>  "Pajak Jackpot",
        "jp_flush"   =>  "Jackpot Flush",
        "jp_four_kind"  =>  "Jackpot 4 Kind",
        "jp_fullhouse"  =>  "Jackpot Full House",
        "jp_royal_flush" => "Jackpot Royal Flush",
        "jp_straight_flush" =>  "Jackpot Straight Flush",
        "lose_exp"      =>  $menu,
        "timer_fast"    =>  $menu,
        "timer_normal"  =>  $menu
    ];
    return $array_menuContent[$menu];

}



?>
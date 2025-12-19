<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script type="text/javascript">
    
    var updt = 'f';
    var idx2 = '';
    var total2 = 0;
	 $(document).ready(function() {
          $("#dialog-modal").dialog({
            height: 630,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });  
		  $( "#dialog-alasan" ).dialog({
            height: 200,
            width: 650,
            modal: true,
            autoOpen:false
        }); 
        $( "#dialog-modal-aaa" ).dialog({
            height: 500,
            width: 500,
            modal: true,
            autoOpen:false
        });                       
     }); 
    $(function(){ 
	$('#trd').edatagrid({
         url: "<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi_head",
			rownumbers:true, 
            fitColumns:false,
            singleSelect:true,
			pagination:"true",                      
            columns:[[
                //{field:'no',title:'ck',width:30,checkbox:true},  
        	    /*{field:'kd_skpd',title:'ID',width:100},
				{field:'kd_unit',title:'ID',width:100},
				{field:'kd_skpd_baru',title:'ID',width:100},
				{field:'no_mutasi',title:'NO B.A MUTASI',width:100},
        	    {field:'tgl_mutasi',title:'TGL B.A MUTASI',width:100},
        	    {field:'lama',title:'SKPD LAMA',width:250},
        	    {field:'baru',title:'SKPD BARU',width:250},
                {field:'ket',title:'KETERANGAN',width:200,align:'left'}*/
                {field:'no_bukti',title:'no_bukti',width:80,hidden:true},
                {field:'sts',title:'STS',width:80},
                {field:'kd_skpd',title:'SKPD B',width:100,hidden:true},
				{field:'kd_unit',title:'Unit B',width:100,hidden:true},
                {field:'kd_skpd_lama',title:'SKPD L',width:100,hidden:true},
                {field:'kd_unit_lama',title:'Unit L',width:100,hidden:true},
				{field:'no_mutasi',title:'NO MUTASI',width:100},
        	    {field:'tgl_mutasi',title:'TGL MUTASI',width:80,align:'center'},
        	    {field:'lama',title:'OPD LAMA',width:250},
        	    {field:'baru',title:'OPD BARU',width:250},
                {field:'ket',title:'KETERANGAN',width:200,align:'left'}

            ]],
        onSelect:function(rowIndex,rowData){
			lcidx 			= rowIndex;
			no_mutasi		= rowData.no_mutasi;
			tgl_mutasi		= rowData.tgl_mutasi;
			kd_unit			= rowData.kd_unit;
			kd_skpd			= rowData.kd_skpd;
            baru            = rowData.baru; 
			kd_skpd_lama	= rowData.kd_skpd_lama; 
            kd_unit_lama    = rowData.kd_unit_lama;
            lama            = rowData.lama;
			jumlah			= rowData.jumlah;
			total			= rowData.total;
			ket				= rowData.ket;
			no_urut			= rowData.no_urut; 
			sts 			= rowData.sts;
			no_bukti 		= rowData.no_bukti;
			},
        onDblClickRow:function(rowIndex,rowData){  
			idx = rowIndex;
			no_mutasi		= rowData.no_mutasi;
			tgl_mutasi		= rowData.tgl_mutasi;
			kd_unit			= rowData.kd_unit;
			kd_skpd			= rowData.kd_skpd;
            baru            = rowData.baru;
			kd_skpd_lama	= rowData.kd_skpd_lama;
            kd_unit_lama    = rowData.kd_unit_lama;
            lama            = rowData.lama;
			jumlah			= rowData.jumlah;
			total			= rowData.total;
			ket				= rowData.ket;
			no_urut			= rowData.no_urut; 
			sts 			= rowData.sts;
			no_bukti 		= rowData.no_bukti;
			//get(no_mutasi,tgl_mutasi,kd_unit,kd_skpd,kd_skpd_lama,jumlah,total,ket,no_urut);     
			var tanggal 	= $('#tanggal').datebox('getValue');
			if(tanggal==''){
				swal({
					title: "",
					text: "TANGGAL PENETAPAN HARUS DIISI.!!",
					type: "warning",
					confirmButtonText: "OK"
					});
			}else{

				if(sts=='DISETUJUI' || sts=='DITOLAK'){
					sweetAlert("Tidak Dapat Di Tetapkan Ulang", "Data Telah Di Lakukan Penetepan", "error");
					$('#trd').edatagrid('unselectAll');
            		exit();
				}else{
					$('#no_mutasi').attr('value',no_mutasi);
					$('#tgl_mutasi').datebox('setValue',tgl_mutasi);
					$('#lama').attr('value',rowData.lama);
					$('#baru').attr('value',rowData.baru);
					$('#skpd_lama').attr('value',rowData.kd_skpd_lama);
					$('#skpd_baru').attr('value',rowData.kd_skpd);
		            $("#dialog-modal").dialog('open'); 
		            $('#tetap').linkbutton("enable");
					loadDetail();
				}	  
			
			}		
		}
        });

	
        $('#trd').edatagrid({    		   
            rownumbers:"true",           
            toolbar:'#toolbar',
            loadMsg:"Load Barang....!!",            
            nowrap:"true"
        });   
        
        $('#tanggal').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 
        $('#tgl_mutasi').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
		 
        $('#tgl_usul').datebox({  
            required:true,
            formatter :function(date){
          	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();    
           	return y+'-'+m+'-'+d;
            }
         });
        
         $('#uskpd').combogrid({  
            panelWidth:700,  
            idField:'kd_uskpd',  
            textField:'kd_uskpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
            columns:[[  
               {field:'kd_uskpd',title:'Kode Unit',width:100},  
               {field:'nm_uskpd',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_uskpd;               
               $('#nmuskpd').attr('value',rowData.nm_uskpd);    
                load_kib(cuskpd);  
				
            } 
         });  
          
                $('#tgl_reg').datebox({  
                    required:true,
                    formatter :function(date){
                  	var y = date.getFullYear();
                   	var m = date.getMonth()+1;
                   	var d = date.getDate();    
                   	return y+'-'+m+'-'+d;
                    }
                });
                
                $('#uskpdb').combogrid({  
                    panelWidth:500,  
                    idField:'kd_skpd',  
                    textField:'kd_skpd',  
                    mode:'remote',                      
                    url:'<?php echo base_url(); ?>index.php/master/ambil_skpd',  
                    columns:[[  
                       {field:'kd_skpd',title:'Kode Unit',width:80},  
                       {field:'nm_skpd',title:'Nama Unit',width:400}    
                    ]],  
                    onSelect:function(rowIndex,rowData){
                       cuskpd = rowData.kd_skpd;               
                       $('#nmuskpdb').attr('value',rowData.nm_skpd);    
                    } 
                 });   
    });
    
   function loadDetail(){
    var i 		   = 0;
    var cuskpd     = kd_skpd_lama; 
	var cno_urut   = no_mutasi;
	var bukti 	   = no_bukti;
    $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi_detail',
        data: ({skpd:cuskpd,nomor:cno_urut,bukti:bukti}),
        dataType:"json",
        success:function(data){                                          
        $.each(data,function(i,n){  
		
		no_reg 			= n['no_reg']; 
		id_barang 		= n['id_barang'];
		idbrg 			= n['idbrg'];
		no 				= n['no'];
		no_oleh 		= n['no_oleh'];
		tgl_reg 		= n['tgl_reg'];
		tgl_oleh 		= n['tgl_oleh'];
		no_dokumen 		= n['no_dokumen'];
		kd_brg 			= n['kd_brg'];
		nm_brg 			= n['nm_brg'];
		detail_brg 		= n['detail_brg'];
		nilai 			= n['nilai'];
		asal 			= n['asal'];
		dsr_peroleh		= n['dsr_peroleh'];
		jumlah 			= n['jumlah'];
		total 			= n['total'];
		merek 			= n['merek'];
		tipe 			= n['tipe'];
		pabrik 			= n['pabrik'];
		kd_warna 		= n['kd_warna'];
		kd_bahan 		= n['kd_bahan'];
		kd_satuan 		= n['kd_satuan'];
		no_rangka 		= n['no_rangka'];
		no_mesin 		= n['no_mesin'];
		no_polisi 		= n['no_polisi'];
		silinder 		= n['silinder'];
		no_stnk 		= n['no_stnk'];
		tgl_stnk 		= n['tgl_stnk'];
		no_bpkb 		= n['no_bpkb'];
		tgl_bpkb 		= n['tgl_bpkb'];
		kondisi 		= n['kondisi'];
		tahun_produksi 	= n['tahun_produksi'];
		dasar 			= n['dasar'];
		no_sk 			= n['no_sk'];
		tgl_sk 			= n['tgl_sk'];
		keterangan 		= n['keterangan'];
		no_mutasi 		= n['no_mutasi'];
		tgl_mutasi 		= n['tgl_mutasi'];
		no_pindah 		= n['no_pindah'];
		tgl_pindah 		= n['tgl_pindah'];
		no_hapus 		= n['no_hapus'];
		tgl_hapus 		= n['tgl_hapus'];
		kd_ruang 		= n['kd_ruang'];
		kd_lokasi2 		= n['kd_lokasi2'];
		kd_skpd 		= n['kd_skpd'];
		kd_unit 		= n['kd_unit'];
		kd_skpd_lama 	= n['kd_skpd_lama'];
		milik 			= n['milik'];
		wilayah 		= n['wilayah'];
		username 		= n['username'];
		tgl_update 		= n['tgl_update'];
		tahun 			= n['tahun'];
		foto 			= n['foto'];
		foto2 			= n['foto2'];
		foto3 			= n['foto3'];
		foto4 			= n['foto4'];
		foto5 			= n['foto5'];
		no_urut 		= n['no_urut'];
		metode 			= n['metode'];
		masa_manfaat 	= n['masa_manfaat'];
		nilai_sisa 		= n['nilai_sisa'];
		kd_riwayat 		= n['kd_riwayat'];
		tgl_riwayat 	= n['tgl_riwayat'];
		detail_riwayat 	= n['detail_riwayat'];
		status_tanah 	= n['status_tanah'];
		no_sertifikat 	= n['no_sertifikat'];
		tgl_sertifikat 	= n['tgl_sertifikat'];
		luas 			= n['luas'];
		penggunaan 		= n['penggunaan'];
		alamat1 		= n['alamat1'];
		alamat2 		= n['alamat2'];
		alamat3 		= n['alamat3'];
		lat 			= n['lat'];
		lon 			= n['lon'];
		luas_gedung 	= n['luas_gedung'];
		jenis_gedung 	= n['jenis_gedung'];
		luas_tanah 		= n['luas_tanah'];
		konstruksi 		= n['konstruksi'];
		konstruksi2 	= n['konstruksi2'];
		luas_lantai 	= n['luas_lantai'];
		kd_tanah 		= n['kd_tanah'];
		hibah 			= n['hibah'];
		panjang 		= n['panjang'];
		lebar 			= n['lebar'];
		perolehan 		= n['perolehan'];
		judul 			= n['judul'];
		spesifikasi 	= n['spesifikasi'];
		cipta 			= n['cipta'];
		tahun_terbit 	= n['tahun_terbit'];
		penerbit 		= n['penerbit'];
		jenis 			= n['jenis'];
		bangunan 		= n['bangunan'];
		tgl_awal_kerja 	= n['tgl_awal_kerja'];
		nilai_kontrak 	= n['nilai_kontrak'];
		auto 			= n['auto'];
		kd_golongan 	= n['kd_golongan'];
		kd_bidang 		= n['kd_bidang'];
		pemeliharaan_ke = n['pemeliharaan_ke'];
		
		$('#trd_mutasi').datagrid('appendRow',{
			no_reg 			:no_reg,
			idbrg 			:idbrg,
			id_barang 		:id_barang,
			nomor 			:no,
			no_oleh 		:no_oleh,
			tgl_reg 		:tgl_reg,
			tgl_oleh 		:tgl_oleh,
			no_dokumen 		:no_dokumen,
			kd_brg 			:kd_brg,
			nm_brg 			:nm_brg,
			detail_brg 		:detail_brg,
			nilai 			:nilai,
			asal 			:asal,
			dsr_peroleh 	:dsr_peroleh,
			jumlah 			:jumlah,
			total 			:total,
			merek 			:merek,
			tipe 			:tipe,
			pabrik 			:pabrik,
			kd_warna 		:kd_warna,
			kd_bahan 		:kd_bahan,
			kd_satuan 		:kd_satuan,
			no_rangka 		:no_rangka,
			no_mesin 		:no_mesin,
			no_polisi 		:no_polisi,
			silinder 		:silinder,
			no_stnk 		:no_stnk,
			tgl_stnk 		:tgl_stnk,
			no_bpkb 		:no_bpkb,
			tgl_bpkb 		:tgl_bpkb,
			kondisi 		:kondisi,
			tahun_produksi 	:tahun_produksi,
			dasar 			:dasar,
			no_sk 			:no_sk,
			tgl_sk 			:tgl_sk,
			keterangan 		:keterangan,
			no_mutasi 		:no_mutasi,
			tgl_mutasi 		:tgl_mutasi,
			no_pindah 		:no_pindah,
			tgl_pindah 		:tgl_pindah,
			no_hapus 		:no_hapus,
			tgl_hapus 		:tgl_hapus,
			kd_ruang 		:kd_ruang,
			kd_lokasi2 		:kd_lokasi2,
			kd_skpd 		:kd_skpd,
			kd_unit 		:kd_unit,
			kd_skpd_lama	:kd_skpd_lama,
			milik 			:milik,
			wilayah 		:wilayah,
			username 		:username,
			tgl_update 		:tgl_update,
			tahun 			:tahun,
			foto 			:foto,
			foto2 			:foto2,
			foto3 			:foto3,
			foto4 			:foto4,
			foto5 			:foto5,
			no_urut 		:no_urut,
			metode 			:metode,
			masa_manfaat 	:masa_manfaat,
			nilai_sisa 		:nilai_sisa,
			kd_riwayat 		:kd_riwayat,
			tgl_riwayat 	:tgl_riwayat,
			detail_riwayat 	:detail_riwayat,
			status_tanah 	:status_tanah,
			no_sertifikat 	:no_sertifikat,
			tgl_sertifikat 	:tgl_sertifikat,
			luas 			:luas,
			penggunaan 		:penggunaan,
			alamat1 		:alamat1,
			alamat2 		:alamat2,
			alamat3 		:alamat3,
			lat 			:lat,
			lon 			:lon,
			luas_gedung 	:luas_gedung,
			jenis_gedung 	:jenis_gedung,
			luas_tanah 		:luas_tanah,
			konstruksi 		:konstruksi,
			konstruksi2 	:konstruksi2,
			luas_lantai 	:luas_lantai,
			kd_tanah 		:kd_tanah,
			hibah 			:hibah,
			panjang 		:panjang,
			lebar 			:lebar,
			perolehan 		:perolehan,
			judul 			:judul,
			spesifikasi 	:spesifikasi,
			cipta 			:cipta,
			tahun_terbit 	:tahun_terbit,
			penerbit 		:penerbit,
			jenis 			:jenis,
			bangunan 		:bangunan,
			tgl_awal_kerja 	:tgl_awal_kerja,
			nilai_kontrak 	:nilai_kontrak,
			auto 			:auto,
			kd_golongan 	:kd_golongan,
			kd_bidang 		:kd_bidang,
			pemeliharaan_ke :pemeliharaan_ke
		}); 

		   });
        }
    });         
    set_grid();
}

function set_grid(){
    $('#trd_mutasi').edatagrid({
       	columns:[[ {                    
		//{field:'',title:'ck',width:30,checkbox:true}, 
			field:'no_reg',title:'NO REG',width:50,hidden:true},
			{field:'idbrg',title:'idbrg',width:50,hidden:true},
			{field:'id_barang',title:'id_barang',width:50,hidden:true},
			{field:'nomor',title:'no',width:100,hidden:true},
			{field:'no_oleh',title:'no_oleh',width:50,hidden:true},
			{field:'tgl_reg',title:'TANGGAL REG',width:100},
			{field:'tgl_oleh',title:'tgl_oleh',width:50,hidden:true},
			{field:'no_dokumen',title:'no_dokumen',width:50,hidden:true},
			{field:'kd_brg',title:'KODE BRG',width:100},
			{field:'nm_brg',title:'NAMA BARANG',width:300},
			{field:'detail_brg',title:'detail_brg',width:50,hidden:true},
			{field:'nilai',title:'HARGA',width:120,align:'right'},
			{field:'asal',title:'asal',width:50,hidden:true},
			{field:'dsr_peroleh',title:'dsr_peroleh',width:50,hidden:true},
			{field:'jumlah',title:'jumlah',width:50,hidden:true},
			{field:'total',title:'total',width:50,hidden:true},
			{field:'merek',title:'merek',width:50,hidden:true},
			{field:'tipe',title:'tipe',width:50,hidden:true},
			{field:'pabrik',title:'pabrik',width:50,hidden:true},
			{field:'kd_warna',title:'kd_warna',width:50,hidden:true},
			{field:'kd_bahan',title:'kd_bahan',width:50,hidden:true},
			{field:'kd_satuan',title:'kd_satuan',width:50,hidden:true},
			{field:'no_rangka',title:'no_rangka',width:50,hidden:true},
			{field:'no_mesin',title:'no_mesin',width:50,hidden:true},
			{field:'no_polisi',title:'no_polisi',width:50,hidden:true},
			{field:'silinder',title:'silinder',width:50,hidden:true},
			{field:'no_stnk',title:'no_stnk',width:50,hidden:true},
			{field:'tgl_stnk',title:'tgl_stnk',width:50,hidden:true},
			{field:'no_bpkb',title:'no_bpkb',width:50,hidden:true},
			{field:'tgl_bpkb',title:'tgl_bpkb',width:50,hidden:true},
			{field:'kondisi',title:'KDS',width:50,align:'center'},
			{field:'tahun_produksi',title:'tahun_produksi',width:50,hidden:true},
			{field:'dasar',title:'dasar',width:50,hidden:true},
			{field:'no_sk',title:'no_sk',width:50,hidden:true},
			{field:'tgl_sk',title:'tgl_sk',width:50,hidden:true},
			{field:'tahun',title:'TAHUN',width:50,align:'center'},
			{field:'keterangan',title:'KET',width:200},
			{field:'no_mutasi',title:'no_mutasi',width:50,hidden:true},
			{field:'tgl_mutasi',title:'tgl_mutasi',width:50,hidden:true},
			{field:'no_pindah',title:'no_pindah',width:50,hidden:true},
			{field:'tgl_pindah',title:'tgl_pindah',width:50,hidden:true},
			{field:'no_hapus',title:'no_hapus',width:50,hidden:true},
			{field:'tgl_hapus',title:'tgl_hapus',width:50,hidden:true},
			{field:'kd_ruang',title:'kd_ruang',width:50,hidden:true},
			{field:'kd_lokasi2',title:'kd_lokasi2',width:50,hidden:true},
			{field:'kd_skpd',title:'kd_skpd',width:50,hidden:true},
			{field:'kd_unit',title:'kd_unit',width:50},
			{field:'kd_skpd_lama',title:'kd_skpd_lama',width:50,hidden:true},
			{field:'milik',title:'milik',width:50,hidden:true},
			{field:'wilayah',title:'wilayah',width:50,hidden:true},
			{field:'username',title:'username',width:50,hidden:true},
			{field:'tgl_update',title:'tgl_update',width:50,hidden:true},
			{field:'foto',title:'foto',width:50,hidden:true},
			{field:'foto2',title:'foto2',width:50,hidden:true},
			{field:'foto3',title:'foto3',width:50,hidden:true},
			{field:'foto4',title:'foto4',width:50,hidden:true},
			{field:'foto5',title:'foto5',width:50,hidden:true},
			{field:'no_urut',title:'no_urut',width:50,hidden:true},
			{field:'metode',title:'metode',width:50,hidden:true},
			{field:'masa_manfaat',title:'masa_manfaat',width:50,hidden:true},
			{field:'nilai_sisa',title:'nilai_sisa',width:50,hidden:true},
			{field:'kd_riwayat',title:'kd_riwayat',width:50,hidden:true},
			{field:'tgl_riwayat',title:'tgl_riwayat',width:50,hidden:true},
			{field:'detail_riwayat',title:'detail_riwayat',width:50,hidden:true},
			{field:'status_tanah',title:'status_tanah',width:50,hidden:true},
			{field:'no_sertifikat',title:'no_sertifikat',width:50,hidden:true},
			{field:'tgl_sertifikat',title:'tgl_sertifikat',width:50,hidden:true},
			{field:'luas',title:'luas',width:50,hidden:true},
			{field:'penggunaan',title:'penggunaan',width:50,hidden:true},
			{field:'alamat1',title:'alamat1',width:50,hidden:true},
			{field:'alamat2',title:'alamat2',width:50,hidden:true},
			{field:'alamat3',title:'alamat3',width:50,hidden:true},
			{field:'lat',title:'lat',width:50,hidden:true},
			{field:'lon',title:'lon',width:50,hidden:true},
			{field:'luas_gedung',title:'luas_gedung',width:50,hidden:true},
			{field:'jenis_gedung',title:'jenis_gedung',width:50,hidden:true},
			{field:'luas_tanah',title:'luas_tanah',width:50,hidden:true},
			{field:'konstruksi',title:'konstruksi',width:50,hidden:true},
			{field:'konstruksi2',title:'konstruksi2',width:50,hidden:true},
			{field:'luas_lantai',title:'luas_lantai',width:50,hidden:true},
			{field:'kd_tanah',title:'kd_tanah',width:50,hidden:true},
			{field:'hibah',title:'hibah',width:50,hidden:true},
			{field:'panjang',title:'panjang',width:50,hidden:true},
			{field:'lebar',title:'lebar',width:50,hidden:true},
			{field:'perolehan',title:'perolehan',width:50,hidden:true},
			{field:'judul',title:'judul',width:50,hidden:true},
			{field:'spesifikasi',title:'spesifikasi',width:50,hidden:true},
			{field:'cipta',title:'cipta',width:50,hidden:true},
			{field:'tahun_terbit',title:'tahun_terbit',width:50,hidden:true},
			{field:'penerbit',title:'penerbit',width:50,hidden:true},
			{field:'jenis',title:'jenis',width:50,hidden:true},
			{field:'bangunan',title:'bangunan',width:50,hidden:true},
			{field:'tgl_awal_kerja',title:'tgl_awal_kerja',width:50,hidden:true},
			{field:'nilai_kontrak',title:'nilai_kontrak',width:50,hidden:true},
			{field:'kd_golongan',title:'kd_golongan',width:50,hidden:true},
			{field:'kd_bidang',title:'kd_bidang',width:50,hidden:true},
			{field:'pemeliharaan_ke',title:'pemeliharaan_ke',width:50,hidden:true}

		]],
        onSelect:function(rowIndex,rowData){
			lcidx 			= rowIndex;
			id_barang		= rowData.id_barang; 
			no_mutasi		= rowData.no_mutasi;
			no_reg			= rowData.no_reg;
			kd_brg			= rowData.kd_brg;
			nm_brg			= rowData.nm_brg;
			skpd			= rowData.kd_skpd_lama;
			tgl_oleh		= rowData.tgl_oleh;
			kondisi			= rowData.kondisi;
			tahun			= rowData.tahun;
			ket				= rowData.keterangan;
			auto			= rowData.auto;
			}
    });
	}
	
    function simpan(){
      $('#trd_mutasi').datagrid('selectAll');
		var a1= [];
		var a2= [];
		var a3= [];
		var a4= [];
		var a5= [];
		var a6= [];
		var a7= [];
		var a8= [];
		var a8x= [];
		var a9= [];
		var a10= [];
		var a11= [];
		var a12= [];
		var a13= [];
		var a14= [];
		var a15= [];
		var a16= [];
		var a17= [];
		var a18= [];
		var a19= [];
		var a20= [];
		var a21= [];
		var a22= [];
		var a23= [];
		var a24= [];
		var a25= [];
		var a26= [];
		var a27= [];
		var a28= [];
		var a29= [];
		var a30= [];
		var a31= [];
		var a32= [];
		var a33= [];
		var a34= [];
		var a35= [];
		var a36= [];
		var a37= [];
		var a38= [];
		var a39= [];
		var a40= [];
		var a41= [];
		var a42= [];
		var a43= [];
		var a44= [];
		var a45= [];
		var a46= [];
		var a47= [];
		var a48= [];
		var a49= [];
		var a50= [];
		var a51= [];
		var a52= [];
		var a53= [];
		var a54= [];
		var a55= [];
		var a56= [];
		var a57= [];
		var a58= [];
		var a59= [];
		var a60= [];
		var a61= [];
		var a62= [];
		var a63= [];
		var a64= [];
		var a65= [];
		var a66= [];
		var a67= [];
		var a68= [];
		var a69= [];
		var a70= [];
		var a71= [];
		var a72= [];
		var a73= [];
		var a74= [];
		var a75= [];
		var a76= [];
		var a77= [];
		var a78= [];
		var a79= [];
		var a80= [];
		var a81= [];
		var a82= [];
		var a83= [];
		var a84= [];
		var a85= [];
		var a86= [];
		var a87= [];
		var a88= [];
		var a89= [];
		var a90= [];
		var a91= [];
		var a92= [];
		var a93= [];
		var a94= [];
		var a95= [];
		var a96= [];

        
		var rows = $('#trd_mutasi').edatagrid('getSelections'); 
		for( i=0; i < rows.length; i++){ 
			a1.push(rows[i].no_reg);
			a2.push(rows[i].id_barang);
			a3.push(rows[i].nomor);
			a4.push(rows[i].no_oleh);
			a5.push(rows[i].tgl_reg);
			a6.push(rows[i].tgl_oleh);
			a7.push(rows[i].no_dokumen);
			a8.push(rows[i].kd_brg);
			a8x.push(rows[i].nm_brg);
			a9.push(rows[i].detail_brg);
			a10.push(angka(rows[i].nilai));
			a11.push(rows[i].asal);
			a12.push(rows[i].dsr_peroleh);
			a13.push(rows[i].jumlah);
			a14.push(rows[i].total);
			a15.push(rows[i].merek);
			a16.push(rows[i].tipe);
			a17.push(rows[i].pabrik);
			a18.push(rows[i].kd_warna);
			a19.push(rows[i].kd_bahan);
			a20.push(rows[i].kd_satuan);
			a21.push(rows[i].no_rangka);
			a22.push(rows[i].no_mesin);
			a23.push(rows[i].no_polisi);
			a24.push(rows[i].silinder);
			a25.push(rows[i].no_stnk);
			a26.push(rows[i].tgl_stnk);
			a27.push(rows[i].no_bpkb);
			a28.push(rows[i].tgl_bpkb);
			a29.push(rows[i].kondisi);
			a30.push(rows[i].tahun_produksi);
			a31.push(rows[i].dasar);
			a32.push(rows[i].no_sk);
			a33.push(rows[i].tgl_sk);
			a34.push(rows[i].keterangan);
			a35.push(rows[i].no_mutasi);
			a36.push(rows[i].tgl_mutasi);
			a37.push(rows[i].no_pindah);
			a38.push(rows[i].tgl_pindah);
			a39.push(rows[i].no_hapus);
			a40.push(rows[i].tgl_hapus);
			a41.push(rows[i].kd_ruang);
			a42.push(rows[i].kd_lokasi2);
			a43.push(rows[i].kd_skpd);
			a44.push(rows[i].kd_unit);
			a45.push(rows[i].kd_skpd_lama);
			a46.push(rows[i].milik);
			a47.push(rows[i].wilayah);
			a48.push(rows[i].username);
			a49.push(rows[i].tgl_update);
			a50.push(rows[i].tahun);
			a51.push(rows[i].foto);
			a52.push(rows[i].foto2);
			a53.push(rows[i].foto3);
			a54.push(rows[i].foto4);
			a55.push(rows[i].foto5);
			a56.push(rows[i].no_urut);
			a57.push(rows[i].metode);
			a58.push(rows[i].masa_manfaat);
			a59.push(rows[i].nilai_sisa);
			a60.push(rows[i].kd_riwayat);
			a61.push(rows[i].tgl_riwayat);
			a62.push(rows[i].detail_riwayat);
			a63.push(rows[i].status_tanah);
			a64.push(rows[i].no_sertifikat);
			a65.push(rows[i].tgl_sertifikat);
			a66.push(rows[i].luas);
			a67.push(rows[i].penggunaan);
			a68.push(rows[i].alamat1);
			a69.push(rows[i].alamat2);
			a70.push(rows[i].alamat3);
			a71.push(rows[i].lat);
			a72.push(rows[i].lon);
			a73.push(rows[i].luas_gedung);
			a74.push(rows[i].jenis_gedung);
			a75.push(rows[i].luas_tanah);
			a76.push(rows[i].konstruksi);
			a77.push(rows[i].konstruksi2);
			a78.push(rows[i].luas_lantai);
			a79.push(rows[i].kd_tanah);
			a80.push(rows[i].hibah);
			a81.push(rows[i].panjang);
			a82.push(rows[i].lebar);
			a83.push(rows[i].perolehan);
			a84.push(rows[i].judul);
			a85.push(rows[i].spesifikasi);
			a86.push(rows[i].cipta);
			a87.push(rows[i].tahun_terbit);
			a88.push(rows[i].penerbit);
			a89.push(rows[i].jenis);
			a90.push(rows[i].bangunan);
			a91.push(rows[i].tgl_awal_kerja);
			a92.push(rows[i].nilai_kontrak);
			a93.push(rows[i].idbrg);
			a94.push(rows[i].kd_golongan);
			a95.push(rows[i].kd_bidang);
			a96.push(rows[i].pemeliharaan_ke);
		}
	 
		no_reg   		=(a1.join('||'));
		id_barang   	=(a2.join('||'));
		no   			=(a3.join('||'));
		no_oleh   		=(a4.join('||'));
		tgl_reg   		=(a5.join('||'));
		tgl_oleh   		=(a6.join('||'));
		no_dokumen   	=(a7.join('||'));
		kd_brg   		=(a8.join('||'));
		nm_brg   		=(a8x.join('||'));
		detail_brg   	=(a9.join('||'));
		nilai   		=(a10.join('||'));
		asal   			=(a11.join('||'));
		dsr_peroleh   	=(a12.join('||'));
		jumlah   		=(a13.join('||'));
		total   		=(a14.join('||'));
		merek   		=(a15.join('||'));
		tipe   			=(a16.join('||'));
		pabrik   		=(a17.join('||'));
		kd_warna   		=(a18.join('||'));
		kd_bahan   		=(a19.join('||'));
		kd_satuan   	=(a20.join('||'));
		no_rangka   	=(a21.join('||'));
		no_mesin   		=(a22.join('||'));
		no_polisi   	=(a23.join('||'));
		silinder   		=(a24.join('||'));
		no_stnk   		=(a25.join('||'));
		tgl_stnk   		=(a26.join('||'));
		no_bpkb   		=(a27.join('||'));
		tgl_bpkb   		=(a28.join('||'));
		kondisi   		=(a29.join('||'));
		tahun_produksi	=(a30.join('||'));
		dasar   		=(a31.join('||'));
		no_sk   		=(a32.join('||'));
		tgl_sk   		=(a33.join('||'));
		keterangan   	=(a34.join('||'));
		no_mutasi   	=(a35.join('||'));
		tgl_mutasi   	=(a36.join('||'));
		no_pindah   	=(a37.join('||'));
		tgl_pindah   	=(a38.join('||'));
		no_hapus   		=(a39.join('||'));
		tgl_hapus   	=(a40.join('||'));
		kd_ruang   		=(a41.join('||'));
		kd_lokasi2   	=(a42.join('||'));
		kd_skpd   		=(a43.join('||'));
		kd_unit   		=(a44.join('||')); 
		kd_skpd_lama   	=(a45.join('||'));
		//kd_skpd_lama	=explode('||',$kd_skpd_lama);
		milik   		=(a46.join('||'));
		wilayah   		=(a47.join('||'));
		username   		=(a48.join('||'));
		tgl_update   	=(a49.join('||'));
		tahun   		=(a50.join('||'));
		foto   			=(a51.join('||'));
		foto2   		=(a52.join('||'));
		foto3   		=(a53.join('||'));
		foto4   		=(a54.join('||'));
		foto5   		=(a55.join('||'));
		no_urut   		=(a56.join('||'));
		metode   		=(a57.join('||'));
		masa_manfaat	=(a58.join('||'));
		nilai_sisa   	=(a59.join('||'));
		kd_riwayat   	=(a60.join('||'));
		tgl_riwayat   	=(a61.join('||'));
		detail_riwayat  =(a62.join('||'));
		status_tanah   	=(a63.join('||'));
		no_sertifikat   =(a64.join('||'));
		tgl_sertifikat  =(a65.join('||'));
		luas   			=(a66.join('||'));
		penggunaan   	=(a67.join('||'));
		alamat1   		=(a68.join('||'));
		alamat2   		=(a69.join('||'));
		alamat3   		=(a70.join('||'));
		lat   			=(a71.join('||'));
		lon   			=(a72.join('||'));
		luas_gedung   	=(a73.join('||'));
		jenis_gedung   	=(a74.join('||'));
		luas_tanah   	=(a75.join('||'));
		konstruksi   	=(a76.join('||'));
		konstruksi2   	=(a77.join('||'));
		luas_lantai   	=(a78.join('||'));
		kd_tanah   		=(a79.join('||'));
		hibah   		=(a80.join('||'));
		panjang   		=(a81.join('||'));
		lebar   		=(a82.join('||'));
		perolehan   	=(a83.join('||'));
		judul   		=(a84.join('||'));
		spesifikasi   	=(a85.join('||'));
		cipta   		=(a86.join('||'));
		tahun_terbit   	=(a87.join('||'));
		penerbit   		=(a88.join('||'));
		jenis   		=(a89.join('||'));
		bangunan   		=(a90.join('||'));
		tgl_awal_kerja  =(a91.join('||'));
		nilai_kontrak   =(a92.join('||'));
		idbrg   		=(a93.join('||'));
		kd_golongan		=(a94.join('||'));
		kd_bidang		=(a95.join('||'));
		pemeliharaan_ke =(a96.join('||'));
		
		var no_mutasi	= document.getElementById('no_mutasi').value;
        var	ctgl_muts  	= $('#tanggal').datebox('getValue');
		var skpd_lama	= document.getElementById('lama').value;
		var skpd_baru	= document.getElementById('baru').value;	
		var rwyt_baru 	= ("Hasil Mutasi dari OPD "+skpd_lama);
		var rwyt_lama 	= ("Sudah Dimutasi ke OPD "+skpd_baru);
        if (ctgl_muts == ''){
            alert('Tanggal Penetepan Mutasi Tidak Boleh Kosong.!');
            exit();              
        } 
		
    var r = confirm("Apakah Anda Yakin ingin Mutasi dari "+skpd_lama+" ke "+skpd_baru+" ??");
	
    if(r==true){
    	$('#tetap').linkbutton("disable");
    	$("#dialog-modal-aaa").dialog('open');
         $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({
                	nomut 			:no_mutasi,
                	tgl_mut 		:ctgl_muts,
                	rwyt_baru 		:rwyt_baru,
                	rwyt_lama 		:rwyt_lama,
                	no_reg 			:no_reg,
                	idbrg 			:idbrg,
                	id_barang 		:id_barang,
                	no 				:no,
                	no_oleh 		:no_oleh,
                	tgl_reg 		:tgl_reg,
                	tgl_oleh 		:tgl_oleh,
                	no_dokumen 		:no_dokumen,
                	kd_brg 			:kd_brg,
                	nm_brg 			:nm_brg,
                	detail_brg 		:detail_brg,
                	nilai 			:nilai,
                	asal 			:asal,
                	dsr_peroleh 	:dsr_peroleh,
                	jumlah 			:jumlah,
                	total 			:total,
					merek 			:merek,
					tipe 			:tipe,
					pabrik 			:pabrik,
					kd_warna 		:kd_warna,
					kd_bahan 		:kd_bahan,
					kd_satuan 		:kd_satuan,
					no_rangka 		:no_rangka,
					no_mesin 		:no_mesin,
					no_polisi 		:no_polisi,
					silinder 		:silinder,
					no_stnk 		:no_stnk,
					tgl_stnk 		:tgl_stnk,
					no_bpkb 		:no_bpkb,
					tgl_bpkb 		:tgl_bpkb,
					kondisi 		:kondisi,
					tahun_produksi 	:tahun_produksi,
					dasar 			:dasar,
					no_sk 			:no_sk,
					tgl_sk 			:tgl_sk,
					keterangan 		:keterangan,
					no_mutasi 		:no_mutasi,
					tgl_mutasi 		:tgl_mutasi,
					no_pindah 		:no_pindah,
					tgl_pindah 		:tgl_pindah,
					no_hapus 		:no_hapus,
					tgl_hapus 		:tgl_hapus,
					kd_ruang 		:kd_ruang,
					kd_lokasi2 		:kd_lokasi2,
					kd_skpd 		:kd_skpd,
					kd_unit 		:kd_unit,
					kd_skpd_lama 	:kd_skpd_lama,
					milik 			:milik,
					wilayah 		:wilayah,
					username 		:username,
					tgl_update 		:tgl_update,
					tahun 			:tahun,
					foto 			:foto,
					foto2 			:foto2,
					foto3 			:foto3,
					foto4 			:foto4,
					foto5 			:foto5,
					no_urut 		:no_urut,
					metode 			:metode,
					masa_manfaat 	:masa_manfaat,
					nilai_sisa 		:nilai_sisa,
					kd_riwayat 		:kd_riwayat,
					tgl_riwayat 	:tgl_riwayat,
					detail_riwayat 	:detail_riwayat,
					status_tanah 	:status_tanah,
					no_sertifikat 	:no_sertifikat,
					tgl_sertifikat 	:tgl_sertifikat,
					luas 			:luas,
					penggunaan 		:penggunaan,
					alamat1 		:alamat1,
					alamat2 		:alamat2,
					alamat3 		:alamat3,
					lat 			:lat,
					lon 			:lon,
					luas_gedung 	:luas_gedung,
					jenis_gedung 	:jenis_gedung,
					luas_tanah 		:luas_tanah,
					konstruksi 		:konstruksi,
					konstruksi2 	:konstruksi2,
					luas_lantai 	:luas_lantai,
					kd_tanah 		:kd_tanah,
					hibah 			:hibah,
					panjang 		:panjang,
					lebar 			:lebar,
					perolehan 		:perolehan,
					judul 			:judul,
					spesifikasi 	:spesifikasi,
					cipta 			:cipta,
					tahun_terbit 	:tahun_terbit,
					penerbit 		:penerbit,
					jenis 			:jenis,
					bangunan 		:bangunan,
					tgl_awal_kerja 	:tgl_awal_kerja,
					nilai_kontrak 	:nilai_kontrak,
					kd_golongan		:kd_golongan,
					kd_bidang		:kd_bidang,
					pemeliharaan_ke	:pemeliharaan_ke
				}),
                url: '<?php echo base_url(); ?>index.php/transaksi/tetap_mutasi_kib',
               success:function(data){ 
               		$("#dialog-modal-aaa").dialog('close');
					swal({
						title: "Data Telah Ditetapkan Dimutasi!",
						type: "success",
						confirmButtonText: "OK"
						});
						keluar();
						$('#trd').edatagrid('reload');  
			}
            });
       });
		}else if(r==false){
			$('#trd_mutasi').edatagrid('unselectAll');
			$('#tetap').linkbutton("enable");
			$("#dialog-modal-aaa").dialog('close');
		}
     }
	 
   function keluar(){
   		$('#trd').edatagrid('reload');
   		$('#trd').edatagrid('unselectAll');
        $("#dialog-modal").dialog('close');
        $("#dialog-alasan").dialog('close');
    }      

	function alasan(){
        $("#dialog-alasan").dialog('open');
    }
	function tolak(){
		var skpd_lama	= document.getElementById('skpd_lama').value;
		var skpd_baru	= document.getElementById('skpd_baru').value;
		var alasan		= document.getElementById('alasan').value;
		var no_mutasi	= document.getElementById('no_mutasi').value;
		if (no_mutasi !=''){
		var del=confirm('Apakah Anda yakin ingin Menolak Usulan Mutasi '+no_mutasi+'?');
		if (del==true){
        var urll = '<?php echo base_url(); ?>index.php/transaksi/tolak_usulan_mutasi';
        $(document).ready(function(){
         $.post(urll,({no_mutasi:no_mutasi,skpdl:skpd_lama,skpdb:skpd_baru,alasan:alasan}),
		 function(data){
					swal({
					title: "",
					text: "Usulan Mutasi Ditolak.!!",
					type: "error",
					confirmButtonText: "OK"
					});
						keluar();
						$('#trd').edatagrid('reload');
         });
        });    
		}}
    }

	function prev_usulan(){
		var rows   	= $('#trd').datagrid('getSelected');
			ca 		= rows.no_mutasi; 
			cb 		= rows.kd_skpd_baru; 
			
	}	
	
function cari(){ 
    var kriteria = document.getElementById("cari_brg").value; 
    $(function(){
     $('#trd').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_listmutasi',
        queryParams:({cari:kriteria})
        });        
     });
    }
function cari2(xx){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#trd').edatagrid({
        url: '<?php echo base_url(); ?>/index.php/transaksi/ambil_mutasi_head',
        queryParams:({cari:xx})
        });        
     });
    }
    
   </script>

<div id="isi">
<p><h3 align="center">PENETAPAN MUTASI BARANG</h3></p>
    <div id="isian">  
        <table>
            <tr hidden="true">
                <td height="30px">KODE UNIT</td>
                <td>:</td>
                <td><input hidden="true" id="uskpd" name="uskpd" style="width: 160px;" /> <input type="text" id="nmuskpd" style="border:0;width: 300px;" readonly="true"/></td>
            </tr>
          </table>
		<table>
		<tr>
			<td>TGL PENETAPAN MUTASI</td>
			<td>:</td>
			<td><input type="text" id="tanggal" style="width: 140px;" /></td> 
			<td><a plain="false">Cari</a>
                <input id="txtcari" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:function(value,name){cari2(value)}" style="width:175px"/></td>				
			<!--td ><input placeholder="*cari nama barang/asal/tujuan" type="text" value="" id="cari_brg" style="width: 250px;" /></td>  
			<td > 
			<a class="easyui-linkbutton" iconCls="icon-file_search" plain="true" onclick="javascript:cari();" ></a>
			</td-->
		</tr>
        </table>

        <table  id="trd" style="width:940px;height:400px;" ></table> 
        <br /> 
		<div id="toolbar" align="center" >
    		<a><b>DAFTAR USULAN MUTASI</b></a>  
        </div>
    </div>  
</div>
<div id="dialog-modal" title="DETAIL USULAN MUTASI">
    <fieldset>  
		<div>
		  <table>
            <tr>
                <td height="30px">NO B.A USULAN MUTASI</td>
                <td>:</td>
                <td><input disabled="true" id="no_mutasi" name="no_mutasi" style="width: 300px; border:0;" /></td>
            </tr>
            <tr>
                <td height="30px">TGL B.A USULAN MUTASI</td>
                <td>:</td>
                <td><input disabled="true" id="tgl_mutasi" name="tgl_mutasi" style="width: 160px;" /></td>
            </tr>
            <tr>
                <td height="30px">MUTASI OPD &nbsp;&nbsp;&nbsp;&nbsp;Dari</td>
                <td></td>
                <td><input readonly="true" id="lama" name="lama" style="width: 300px; border:1;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ke&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input readonly="true" id="baru" name="baru" style="width: 300px; border:1;" /></td>
            </tr>
            <tr hidden="true">
                <td height="30px">KODE OPD</td>
                <td>:</td>
                <td><input disabled="true" id="skpd_lama" name="skpd_lama" style="width: 160px;" />
				<input disabled="true" id="skpd_baru" name="skpd_baru" style="width: 160px;" /></td>
            </tr>
          </table>		
        <br/>
        <table  id="trd_mutasi" title="Rincian Barang" style="width:950px;height:360px;" >  
        </table><br/> 
    <fieldset>
        <table align="center">
            <tr>
                <td>
					<a class="easyui-linkbutton" iconCls="icon-cancel" plain="false" onclick="javascript:alasan();">TOLAK MUTASI</a>
                    <a class="easyui-linkbutton" id="tetap" iconCls="icon-ok" plain="false" onclick="javascript:simpan();">TETAPKAN MUTASI</a> 
					<!-- <a class="easyui-linkbutton" iconCls="icon-report" plain="true" onclick="javascript:prev_usulan();">CETAK USULAN</a> -->					
					<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">KEMBALI</a>					
				</td>
            </tr>
        </table>   
    </fieldset>	
    </div>  
    </fieldset>
</div>
<div id="dialog-alasan" title="ALASAN PENOLAKAN">
    <fieldset>  
		<div>
		  <table>
            <tr>
                <td height="50px">ALASAN PENOLAKAN</td>
                <td>:</td>
                <td><textarea id="alasan" name="alasan" style="width: 400px; border:1;"></textarea></td>
            </tr>
          </table>		
        <br/>
    <fieldset>
        <table align="center">
            <tr>
                <td>
                    <a class="easyui-linkbutton" iconCls="icon-ok" plain="false" onclick="javascript:tolak();">OK</a> 
					<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">KEMBALI</a>					
				</td>
            </tr>
        </table>   
    </fieldset>	
    </div>  
    </fieldset>
</div>
<div id="dialog-modal-aaa" title="MOHON TUNGGU SEBENTAR">
    <p class="validateTips"></p>  
    <fieldset>
    <table>
    <tr height="70%" >
      <td colspan="3" align="center"  > 
      <DIV id="load" > <b>Sedang Proses harap tunggu</b><IMG src="<?php echo base_url(); ?>lib/images/load.gif"  BORDER="0" ALT=""></DIV></td>
    </tr>
    </table>
    
    </fieldset>
  
</div>
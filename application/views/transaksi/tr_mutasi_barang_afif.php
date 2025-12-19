<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/autoCurrency.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>easyui/currencyFields.js"></script>
<script type="text/javascript">
    
    var updt = '';
    var idx2 = '';
    var total2 = 0;
    var nomor_bukti='';
    
     $(document).ready(function() {
          $("#tabs").tabs();
          $("#dialog-modal").dialog({
            height: 600,
            width: 1000,
            modal: true, 
            background:'#2da305',           
            autoOpen:false                
          });                       
     });    
     
    $(function(){  
         $('#trh').edatagrid({
    		url: "<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi_head",
			rownumbers:true, 
            fitColumns:false,
            singleSelect:true,
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
			pagination:"true",                      
            columns:[[
				{field:'del',title:'DEL',width:50,align:'center',formatter:function(value,rec){ return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_usulan();'' />";}},
        	    {field:'no_bukti',title:'Bukti',width:70,align:'center'},
                {field:'sts',title:'STATUS',width:100,align:'center'},
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
            no_bukti        = rowData.no_bukti;
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
			},
        onDblClickRow:function(rowIndex,rowData){  
			idx = rowIndex;
            no_bukti        = rowData.no_bukti;
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
            updt            = 't';
            sts             = rowData.sts;
            if(sts=='DITOLAK' || sts=='DISETUJUI'){
                $('#c_simpan').linkbutton('disable');
                $('#tambah_detail').linkbutton('disable');
                $('#hapus_det').linkbutton('disable');
            }
			get(no_bukti,no_mutasi,tgl_mutasi,kd_unit,kd_skpd,kd_skpd_lama,jumlah,total,ket,no_urut,kd_unit_lama,lama,baru);
			loadDetail();
			tab2();
		}
        });
                
         $('#trd2').edatagrid({    		
            idField:"no_dokumen",            
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",             
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
            onSelect:function(rowIndex,rowData){
                idx2 = rowIndex;
                var b = rowData.kd_brg;
                var jns = b.slice(0,2);   
                updt = 't';                             
                get2(jns,rowData.kd_brg,rowData.nm_brg,rowData.merek,rowData.jumlah,rowData.harga,rowData.total,rowData.ket); 
            }          
        });
        
        $('#trd').edatagrid({    		   
            rownumbers:"true",           
            toolbar:'#toolbar',
            loadMsg:"Load Barang....!!",            
            nowrap:"true",
            singleSelect:"true"
        });   
		
        $('#trd_mutasi').edatagrid({    		   
            rownumbers:"true",           
            //toolbar:'#toolbar',
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
        
         $('#uskpd').combogrid({  
            panelWidth:700,  
            width:100,  
            idField:'kd_skpd',  
            textField:'kd_skpd',  
            mode:'remote',                      
            url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
            columns:[[  
               {field:'kd_skpd',title:'Kode OPD',width:100},  
               {field:'nm_skpd',title:'Nama OPD',width:250},
               {field:'kd_lokasi',title:'Kode Unit',width:100},  
               {field:'nm_lokasi',title:'Nama Unit',width:250}    
            ]],  
            onSelect:function(rowIndex,rowData){
               cuskpd = rowData.kd_lokasi;      
               skpd   = rowData.kd_skpd;              
               $('#nmuskpd').attr('value',rowData.nm_skpd); 
               $('#skpd').attr('value',rowData.kd_lokasi);    
                //nomer_akhir();
                if(updt=='f'){
                    ambil_nomor();
                }
				
            } 
         });  
        
        $('#kib').combogrid({  
            panelWidth:400,  
            width:160,
            idField:'golongan',  
            textField:'nm_golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              cgol = rowData.golongan;                                
                load_kib();  
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
                    panelWidth:700,  
                    width:100,  
                    idField:'kd_skpd',  
                    textField:'kd_skpd',  
                    mode:'remote',                      
                    url:'<?php echo base_url(); ?>index.php/master/ambil_msskpd2',  
                    columns:[[  
                       {field:'kd_skpd',title:'Kode OPD',width:100},  
                       {field:'nm_skpd',title:'Nama OPD',width:250},
                       {field:'kd_lokasi',title:'Kode Unit',width:100},  
                       {field:'nm_lokasi',title:'Nama Unit',width:250}    
                    ]],  
                    onSelect:function(rowIndex,rowData){
                       cskpd = rowData.kd_lokasi;     
                       cuskpd = rowData.kd_skpd;              
                       $('#nmuskpdb').attr('value',rowData.nm_skpd);
                       $('#skpdx').attr('value',cskpd);    
                    } 
                 });   
				 
				 //$('#tanggal').datebox('setValue','<?php echo date('Y-m-d')?>');
    });
	
    
      function nomer_akhir(){
        var i 		= 0; 
        var tabel 	='mutasi_brg'
        var kd_unit	= cuskpd; 
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/transaksi/nomor',
            data: ({tabel:'mutasi_brg',kd_unit:kd_unit}),
            dataType:"json",
            success:function(data){                                          
                $.each(data,function(i,n){                                    
                    nom      = n['urut'];  
					nomorku	= tambah_urut(nom,4);
                    no_reg   = n['no_reg'];  
                    //$("#no_urut").attr("value",nomorku);
                    $("#no_reg").attr("value",no_reg);                          
                });
            }
        });        
    }
	
    function tambah_urut(angka,panjang){
        no=((angka)*1);
        a=no.toString();
        jnol=panjang-a.length;
        nol='';
        for(i=1;i<=jnol;i++){
        nol=nol+'0';
        }
        b= nol+a;
        return b;
    }
	
    function section1(){        
        $('#tabs1').click(); 
        set_grid(); 
        $('#trh').datagrid('reload');                                              
    }
	
    function section2(){            
        $('#tabs2').click();
        document.getElementById('no_urut').focus();
        loadDetail();
        set_grid();                                                        
    
    }
   
   /****************************PERUBAHAN********************************/
   function loadDetail(){
    var i 		   = 0;
    var bukti      = document.getElementById('nomor_bukti').value;
    var cuskpd     = $('#uskpd').combogrid('getValue'); 
	var cno_urut   = document.getElementById('no_urut').value;
    $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi_detail',
        data: ({skpd:cuskpd,nomor:cno_urut,bukti:bukti}),
        dataType:"json",
        success:function(data){                                          
        $.each(data,function(i,n){  
        idx             = n['idx']; 
		no_bukti        = n['no_bukti'];
		no_reg 		    = n['no_reg'];
		id_barang 	    = n['id_barang'];
		no 			    = n['no'];
		no_oleh 	    = n['no_oleh'];
		tgl_reg 	    = n['tgl_reg'];
		tgl_oleh 	    = n['tgl_oleh'];
		no_dokumen 	    = n['no_dokumen'];
		kd_brg 		    = n['kd_brg'];
		nm_brg 		    = n['nm_brg'];
		detail_brg 	    = n['detail_brg'];
		nilai 		    = n['nilai'];
		asal 		    = n['asal'];
		dsr_peroleh	    = n['dsr_peroleh'];
		jumlah 		    = n['jumlah'];
		total 		    = n['total'];
		merek 		    = n['merek'];
		tipe 		    = n['tipe'];
		pabrik 		    = n['pabrik'];
		kd_warna 	    = n['kd_warna'];
		kd_bahan 	    = n['kd_bahan'];
		kd_satuan 	    = n['kd_satuan'];
		no_rangka 	    = n['no_rangka'];
		no_mesin 	    = n['no_mesin'];
		no_polisi 	    = n['no_polisi'];
		silinder 	    = n['silinder'];
		no_stnk 	    = n['no_stnk'];
		tgl_stnk 	    = n['tgl_stnk'];
		no_bpkb 	    = n['no_bpkb'];
		tgl_bpkb 	    = n['tgl_bpkb'];
		kondisi 	    = n['kondisi'];
		tahun_produksi 	= n['tahun_produksi'];
		dasar 		    = n['dasar'];
		no_sk 		    = n['no_sk'];
		tgl_sk 		    = n['tgl_sk'];
		keterangan 	    = n['keterangan'];
		no_mutasi 	    = n['no_mutasi'];
		tgl_mutasi 	    = n['tgl_mutasi'];
		no_pindah 	    = n['no_pindah'];
		tgl_pindah 	    = n['tgl_pindah'];
		no_hapus 	    = n['no_hapus'];
		tgl_hapus 	    = n['tgl_hapus'];
		kd_ruang 	    = n['kd_ruang'];
		kd_lokasi2 	    = n['kd_lokasi2'];
		kd_skpd 	    = n['kd_skpd'];
		kd_unit 	    = n['kd_unit'];
		kd_skpd_lama 	= n['kd_skpd_lama'];
		milik 	        = n['milik'];
		wilayah 	    = n['wilayah'];
		username 	    = n['username'];
		tgl_update 	    = n['tgl_update'];
		tahun 	        = n['tahun'];
		foto 	        = n['foto'];
		foto2 	        = n['foto2'];
		foto3 	        = n['foto3'];
		foto4 	        = n['foto4'];
		foto5 	        = n['foto5'];
		no_urut 	    = n['no_urut'];
		metode 	        = n['metode'];
		masa_manfaat 	= n['masa_manfaat'];
		nilai_sisa 	    = n['nilai_sisa'];
		kd_riwayat 	    = n['kd_riwayat'];
		tgl_riwayat 	= n['tgl_riwayat'];
		detail_riwayat 	= n['detail_riwayat'];
		status_tanah 	= n['status_tanah'];
		no_sertifikat 	= n['no_sertifikat'];
		tgl_sertifikat 	= n['tgl_sertifikat'];
		luas 	        = n['luas'];
		penggunaan 	    = n['penggunaan'];
		alamat1 	    = n['alamat1'];
		alamat2 	    = n['alamat2'];
		alamat3 	    = n['alamat3'];
		lat 	        = n['lat'];
		lon 	        = n['lon'];
		luas_gedung 	= n['luas_gedung'];
		jenis_gedung 	= n['jenis_gedung'];
		luas_tanah 	    = n['luas_tanah'];
		konstruksi 	    = n['konstruksi'];
		konstruksi2 	= n['konstruksi2'];
		luas_lantai 	= n['luas_lantai'];
		kd_tanah 	    = n['kd_tanah'];
		hibah 	        = n['hibah'];
		panjang 	    = n['panjang'];
		lebar 	        = n['lebar'];
		perolehan 	    = n['perolehan'];
		judul 	        = n['judul'];
		spesifikasi 	= n['spesifikasi'];
		cipta 	        = n['cipta'];
		tahun_terbit 	= n['tahun_terbit'];
		penerbit 	    = n['penerbit'];
		jenis 	        = n['jenis'];
		bangunan 	    = n['bangunan'];
		tgl_awal_kerja 	= n['tgl_awal_kerja'];
		nilai_kontrak 	= n['nilai_kontrak'];
		auto 	        = n['auto'];
        pemeliharaan_ke = n['pemeliharaan_ke'];
        kd_golongan     = n['kd_golongan'];
        kd_bidang       = n['kd_bidang'];
		
		$('#trd').datagrid('appendRow',{
            idx             :idx ,
            no_bukti        :no_bukti ,
            no_reg          :no_reg,
            id_barang       :id_barang,
            nomor           :no,
            no_oleh         :no_oleh,
            tgl_reg         :tgl_reg,
            tgl_oleh        :tgl_oleh,
            no_dokumen      :no_dokumen,
            kd_brg          :kd_brg,
            nm_brg          :nm_brg,
            detail_brg      :detail_brg,
            nilai           :nilai,
            asal            :asal,
            dsr_peroleh     :dsr_peroleh,
            jumlah          :jumlah,
            total           :total,
    		merek           :merek,
            tipe            :tipe,
            pabrik          :pabrik,
            kd_warna        :kd_warna,
            kd_bahan        :kd_bahan,
            kd_satuan       :kd_satuan,
            no_rangka       :no_rangka,
            no_mesin        :no_mesin,
            no_polisi       :no_polisi,
            silinder        :silinder,
            no_stnk         :no_stnk,
            tgl_stnk        :tgl_stnk,
            no_bpkb         :no_bpkb,
    		tgl_bpkb        :tgl_bpkb,
            kondisi         :kondisi,
            tahun_produksi  :tahun_produksi,
            dasar           :dasar,
            no_sk           :no_sk,
            tgl_sk          :tgl_sk,
            keterangan      :keterangan,
            no_mutasi       :no_mutasi,
            tgl_mutasi      :tgl_mutasi,
            no_pindah       :no_pindah,
            tgl_pindah      :tgl_pindah,
    		no_hapus        :no_hapus,
            tgl_hapus       :tgl_hapus,
            kd_ruang        :kd_ruang,
            kd_lokasi2      :kd_lokasi2,
            kd_skpd         :kd_skpd,
            kd_unit         :kd_unit,
            kd_skpd_lama    :kd_skpd_lama,
            milik           :milik,
            wilayah         :wilayah,
            username        :username,
            tgl_update      :tgl_update,
            tahun           :tahun,
            foto            :foto,
            foto2           :foto2,
            foto3           :foto3,
            foto4           :foto4,
            foto5           :foto5,
            no_urut         :no_urut,
            metode          :metode,
            masa_manfaat    :masa_manfaat,
            nilai_sisa      :nilai_sisa,
            kd_riwayat      :kd_riwayat,
            tgl_riwayat     :tgl_riwayat,
    		detail_riwayat  :detail_riwayat,
            status_tanah    :status_tanah,
            no_sertifikat   :no_sertifikat,
            tgl_sertifikat  :tgl_sertifikat,
            luas            :luas,
            penggunaan      :penggunaan,
            alamat1         :alamat1,
            alamat2         :alamat2,
            alamat3         :alamat3,
    		lat             :lat,
            lon             :lon,
            luas_gedung     :luas_gedung,
            jenis_gedung    :jenis_gedung,
            luas_tanah      :luas_tanah,
            konstruksi      :konstruksi,
            konstruksi2     :konstruksi2,
            luas_lantai     :luas_lantai,
            kd_tanah        :kd_tanah,
    		hibah           :hibah,
            panjang         :panjang,
            lebar           :lebar,
            perolehan       :perolehan,
            judul           :judul,
            spesifikasi     :spesifikasi,
    		cipta           :cipta,
            tahun_terbit    :tahun_terbit,
            penerbit        :penerbit,
            jenis           :jenis,
            bangunan        :bangunan,
            tgl_awal_kerja  :tgl_awal_kerja,
            nilai_kontrak   :nilai_kontrak,
            auto            :auto,
            pemeliharaan_ke :pemeliharaan_ke,
            kd_golongan     :kd_golongan,
            kd_bidang       :kd_bidang
    }); 
		   });
        }
    });         
    set_grid();
    
}

/*function set_grid(){
    $('#trd').edatagrid({
        singleSelect:"true",
       	columns:[[ 
                    //{field:'no',title:'ck',width:30,checkbox:true}, , 
					{field:'hapus',width:30,align:'center',formatter:function(value,rec)
					{return "<img src='<?php echo base_url(); ?>/public/images/cross.png' onclick='javascript:hapus_detail();''/>";}},
            	    {field:'id_barang',title:'ID',width:50,hidden:true},
            	    {field:'no_mutasi',title:'Nomor Dokumen',width:50,hidden:true},
                    {field:'no_reg',title:'NO REG ',width:60,align:"center"},
                    {field:'kd_brg',title:'KODE BARANG',width:110},
                    {field:'nm_brg',title:'NAMA BARANG',width:300},
                    {field:'tgl_oleh',title:'TANGGAL',width:100,align:"center"},
                    {field:'kondisi',title:'KONDISI',width:100,align:"center"},
                    {field:'tahun',title:'TAHUN',width:70,align:"center"},
                    {field:'keterangan',title:'KET',width:300}
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
	}*/

function set_grid(){
    $('#trd').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",             
            singleSelect:"true",
            autoRowHeight:"false",
            toolbar:"#toolbar",
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    
            },                                                     
            columns:[[  
             
            {field:'idx',title:'idx',width:50,align:'left',hidden:'true'},
            {field:'no_bukti',title:'no_bukti',width:100,align:'center',hidden:true},
            {field:'nomut',title:'nomut',width:50,align:'left',hidden:true},
            {field:'tgl_mut',title:'tgl_mut',width:50,align:'left',hidden:true},
            {field:'riwayat',title:'riwayat',width:50,align:'left',hidden:true }, 
            {field:'nmuskpdb',title:'nmuskpdb',width:50,align:'left',hidden:true }, 
            {field:'no_reg',title:'no_reg',width:50,align:'left',hidden:true },
            {field:'id_barang',title:'id_barang',width:50,align:'left',hidden:true },
            {field:'nomor',title:'nomor',width:50,align:'left',hidden:true },
            {field:'no_oleh',title:'no_oleh',width:50,align:'left',hidden:true },
            {field:'tgl_reg',title:'tgl_reg',width:220,align:'left',hidden:true },
            {field:'tgl_oleh',title:'tgl_oleh',width:110,align:'left',hidden:true},
            {field:'no_dokumen',title:'No Dok',width:150,align:'left'},
            {field:'kd_brg',title:'Kd Brg',width:100,align:'left'},
            {field:'nm_brg',title:'Nm Brg',width:200,align:'left'},
            {field:'detail_brg',title:'detail_brg',width:50,align:'left',hidden:true },
            {field:'nilai',title:'Nilai',width:130,align:'right'},
            {field:'asal',title:'asal',width:50,align:'left',hidden:true },
            {field:'dsr_peroleh',title:'dsr_peroleh',width:50,align:'left',hidden:true },
            {field:'jumlah',title:'jumlah',width:50,align:'left',hidden:true },
            {field:'total',title:'total',width:50,align:'left',hidden:true },
            {field:'merek',title:'merek',width:50,align:'left',hidden:true },
            {field:'tipe',title:'tipe',width:50,align:'left',hidden:true },
            {field:'pabrik',title:'pabrik',width:50,align:'left',hidden:true },
            {field:'kd_warna',title:'kd_warna',width:50,align:'left',hidden:true },
            {field:'kd_bahan',title:'kd_bahan',width:50,align:'left',hidden:true },
            {field:'kd_satuan',title:'kd_satuan',width:250,align:'left',hidden:true },
            {field:'no_rangka',title:'no_rangka',width:50,align:'left',hidden:true }, 
            {field:'no_mesin',title:'no_mesin',width:50,align:'left',hidden:true },
            {field:'no_polisi',title:'no_polisi',width:50,align:'left',hidden:true },
            {field:'silinder',title:'silinder',width:50,align:'left',hidden:true },
            {field:'no_stnk',title:'no_stnk',width:50,align:'left',hidden:true },
            {field:'tgl_stnk',title:'tgl_stnk',width:50,align:'left',hidden:true },
            {field:'no_bpkb',title:'no_bpkb',width:50,align:'left',hidden:true },
            {field:'tgl_bpkb',title:'tgl_bpkb',width:50,align:'left',hidden:true },
            {field:'kondisi',title:'KDS',width:30,align:'center'},
            {field:'tahun_produksi',title:'tahun_produksi',width:50,align:'left',hidden:true },
            {field:'dasar',title:'dasar',width:50,align:'left',hidden:true },
            {field:'no_sk',title:'no_sk',width:50,align:'left',hidden:true },
            {field:'tgl_sk',title:'tgl_sk',width:50,align:'left',hidden:true },
            {field:'tahun',title:'THN',width:50,align:'center'},
            {field:'keterangan',title:'Ket',width:250,align:'left'},
            {field:'no_mutasi',title:'no_mutasi',width:50,align:'left',hidden:true },
            {field:'tgl_mutasi',title:'tgl_mutasi',width:50,align:'left',hidden:true },
            {field:'no_pindah',title:'no_pindah',width:50,align:'left',hidden:true },
            {field:'tgl_pindah',title:'tgl_pindah',width:50,align:'left',hidden:true },
            {field:'no_hapus',title:'no_hapus',width:50,align:'left',hidden:true },
            {field:'tgl_hapus',title:'tgl_hapus',width:150,align:'right',hidden:true },
            {field:'kd_ruang',title:'kd_ruang',width:50,hidden:true},
            {field:'kd_lokasi2',title:'kd_lokasi2',width:50,align:'left',hidden:true},
            {field:'kd_skpd',title:'kd_skpd',width:50,align:'left',hidden:true},
            {field:'kd_unit',title:'kd_unit',width:50,align:'left',hidden:true }, 
            {field:'kd_skpd_lama',title:'kd_skpd_lama',width:50,align:'left',hidden:true }, 
            {field:'milik',title:'milik',width:50,align:'left',hidden:true },
            {field:'wilayah',title:'wilayah',width:50,align:'left',hidden:true },
            {field:'foto',title:'foto',width:50,align:'left',hidden:true },
            {field:'foto2',title:'foto2',width:220,align:'left',hidden:true },
            {field:'foto3',title:'foto3',width:110,align:'left',hidden:true},
            {field:'foto4',title:'foto4',width:110,align:'left',hidden:true },
            {field:'foto5',title:'foto5',width:150,align:'left',hidden:true },
            {field:'no_urut',title:'no_urut',width:50,align:'left',hidden:true },
            {field:'metode',title:'metode',width:50,align:'left',hidden:true },
            {field:'masa_manfaat',title:'masa_manfaat',width:50,align:'left',hidden:true },
            {field:'nilai_sisa',title:'nilai_sisa',width:50,align:'left',hidden:true },
            {field:'kd_riwayat',title:'kd_riwayat',width:50,align:'left',hidden:true },
            {field:'tgl_riwayat',title:'tgl_riwayat',width:50,align:'left',hidden:true },
            {field:'detail_riwayat',title:'detail_riwayat',width:50,align:'left',hidden:true },
            {field:'status_tanah',title:'status_tanah',width:50,align:'left',hidden:true },
            {field:'no_sertifikat',title:'no_sertifikat',width:50,align:'left',hidden:true },
            {field:'tgl_sertifikat',title:'tgl_sertifikat',width:50,align:'left',hidden:true },
            {field:'luas',title:'luas',width:50,align:'left',hidden:true },
            {field:'penggunaan',title:'penggunaan',width:50,align:'left',hidden:true },
            {field:'alamat1',title:'alamat1',width:250,align:'left',hidden:true },
            {field:'alamat2',title:'alamat2',width:50,align:'left',hidden:true }, 
            {field:'alamat3',title:'alamat3',width:50,align:'left',hidden:true },
            {field:'lat',title:'lat',width:50,align:'left',hidden:true },
            {field:'lon',title:'lon',width:50,align:'left',hidden:true },
            {field:'luas_gedung',title:'luas_gedung',width:50,align:'left',hidden:true },
            {field:'jenis_gedung',title:'jenis_gedung',width:50,align:'left',hidden:true },
            {field:'luas_tanah',title:'luas_tanah',width:50,align:'left',hidden:true },
            {field:'konstruksi',title:'konstruksi',width:50,align:'left',hidden:true },
            {field:'konstruksi2',title:'konstruksi2',width:50,align:'left',hidden:true },
            {field:'luas_lantai',title:'luas_lantai',width:50,align:'left',hidden:true },
            {field:'kd_tanah',title:'kd_tanah',width:50,align:'left',hidden:true },
            {field:'hibah',title:'hibah',width:50,align:'left',hidden:true },
            {field:'panjang',title:'panjang',width:50,align:'left',hidden:true },
            {field:'lebar',title:'lebar',width:50,align:'left',hidden:true },
            {field:'perolehan',title:'perolehan',width:50,align:'left',hidden:true },
            {field:'judul',title:'judul',width:50,align:'left',hidden:true },
            {field:'spesifikasi',title:'spesifikasi',width:50,align:'left',hidden:true },
            {field:'cipta',title:'cipta',width:50,align:'left',hidden:true },
            {field:'tahun_terbit',title:'tahun_terbit',width:50,align:'left',hidden:true },
            {field:'penerbit',title:'penerbit',width:150,align:'right',hidden:true },
            {field:'jenis',title:'jenis',width:50,hidden:true},
            {field:'bangunan',title:'bangunan',width:50,align:'left',hidden:true},
            {field:'tgl_awal_kerja',title:'tgl_awal_kerja',width:50,align:'left',hidden:true},
            {field:'nilai_kontrak',title:'nilai_kontrak',width:50,align:'left',hidden:true }, 
            {field:'kd_golongan',title:'kd_golongan',width:50,align:'left',hidden:true }, 
            {field:'kd_bidang',title:'kd_bidang',width:50,align:'left',hidden:true },
            {field:'pemeliharaan_ke',title:'pemeliharaan_ke',width:50,align:'left',hidden:true }
         
    
            ]]
        });
}
   /*************************END PERUBAHAN*************************************/
   
    function load_kib(){
        
        $('#trd').datagrid('selectAll');
           var rows = $('#trd').datagrid('getSelections');                
           idb  = '';
           id_b = '';
           
           for ( var p=0; p < rows.length; p++ ) { 
           id_b = rows[p].id_barang;                                       
           if ( p > 0 ){   
                  idb = idb+','+"'"+id_b+"'";
              } else {
                  idb = "'"+id_b+"'";
              }
           }



        var i 		= 0;
        var ngol 	= $('#kib').combogrid('getValue');//cgol;
        var cuskpd  = $('#uskpd').combogrid('getValue');
        var unit    = document.getElementById('skpd').value; 
		var cari 	= document.getElementById('cari_brg');
        $('#trd_mutasi').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi',
            queryParams:({kdskpd:cuskpd,gol:ngol,unit:unit,idb:idb}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
			pagination:"true",
			columns:[[ 
                    {field:'no',title:'ck',width:30,checkbox:true}, 
                    {field:'no_reg',title:'NO REG',width:75},
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
                    {field:'kd_unit',title:'kd_unit',width:50,hidden:true},
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
                    {field:'pemeliharaan_ke',title:'pemeliharaan_ke',width:50,hidden:true},

                ]] 
			});
        $('#trd').datagrid('unselectAll');
    }

    function load_kib_kosong(){
        var ngol    = '';
        var cuskpd  = '';
        var unit    = '';
        var cari    = '';
        $('#trd_mutasi').edatagrid({
            url: '<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi',
            queryParams:({kdskpd:cuskpd,gol:ngol,unit:unit,idb:''}),
            rownumbers:true, 
            fitColumns:false,
            singleSelect:false,
            pagination:"true",
            columns:[[ 
                    {field:'no',title:'ck',width:30,checkbox:true}, 
                    {field:'no_reg',title:'NO REG',width:75},
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
                    {field:'kd_unit',title:'kd_unit',width:50,hidden:true},
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
                    {field:'pemeliharaan_ke',title:'pemeliharaan_ke',width:50,hidden:true},

                ]] 
            });
    }

    function tambah_detail(){
        var no = document.getElementById('no_urut').value;
        var tgl = $('#tanggal').datebox('getValue');
        var kd  = $('#uskpd').combogrid('getValue'); 
        var kdb  = $('#uskpdb').combogrid('getValue'); 

        /*if (no!='' && tgl!='' && kd!='' && kdb!=''){
                   
        } else {
            alert('Nomor B.A Usulan Mutasi/Tanggal/SKPD/SKPD Baru masih kosong, harap isi terlebih dahulu.!');
        } */
        if(no==''){
            swal({
                    title: "Nomor Tidak Boleh Kosong",
                    type:"warning"
                    });
            exit();
        } 
        if(tgl==''){
            swal({
                    title: "Tanggal Tidak Boleh Kosong",
                    type:"warning"
                    });
            exit();
        }   

        if(kd=='' || kdb==''){
            swal({
                    title: "Kode OPD Tidak Boleh Kosong",
                    type:"warning"
                    });
            exit();
        } 

        if(kd==kdb){
            swal({
                  title:"Apakah Anda Yakin OPD Sama?" ,
                  text:"Kode SKPD "+kd+" --- "+kdb+"?",
                  type: "warning",
                  html:true,
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ya",
                  cancelButtonText: "Tidak",
                  closeOnConfirm: true,
                  closeOnCancel: true
                },
                function(isConfirm){
                        $("#dialog-modal").dialog('open');
                        kosong2();
                    
                });
        }else{
            $("#dialog-modal").dialog('open');
            kosong2();
        }    

        
    }
	
    function tab2(){
   $('#tabs2').click()
  }
  
	function get(no_bukti,no_mutasi,tgl_mutasi,kd_unit,kd_skpd,kd_skpd_lama,jumlah,total,ket,no_urut,kd_unit_lama,lama,baru){
		$("#no_urut").attr("value",no_mutasi);
		$("#tanggal").datebox("setValue",tgl_mutasi);
		$("#uskpd").combogrid("setValue",kd_skpd_lama);
        $("#uskpd").combogrid("disable");
		$("#skpd").attr("value",kd_unit_lama);
        $("#nmuskpd").attr("value",lama);
        //$("$nmuskpdb").attr("value",baru);
        $("#skpdx").attr("value",kd_unit);
		$("#uskpdb").combogrid("setValue",kd_skpd);
        $("#uskpdb").combogrid("disable");
		$("#keterangan").attr("value",ket);
        $('#no_urut').attr('disabled',true);
        $('#nomor_bukti').attr('value',no_bukti);
	}
   function get2(no_reg,id_brg,nomor,kode,nama,tgl,kondisi,tahun,harga){ 
        $('#reg').attr('value',no_reg);
        $('#kd').attr('value',kode);
        $('#nm').attr('value',nama); 
        $('#tgl_reg').datebox('setValue',tgl);
        $('#kds').attr('value',kondisi);
        $('#thn').attr('value',tahun);
        $('#hrg').attr('value',harga); 
        $('#id_brg').attr('value',id_brg);      
    }
    
    function kosong(){
        var tanggal	= '<?php echo date('Y-m-d');?>';
       //var skpd	= '<?php echo ($this->session->userdata('skpd'));?>';
		$('#no_urut').attr('value','');
        $('#tanggal').datebox('setValue',tanggal);
        $('#uskpd').combogrid('clear');
		$('#nmuskpd').attr('value','');
		$('#skpd').attr('value','');
        $('#skpdx').attr('value','');
        $('#kib').combogrid('setValue','');
        $('#uskpdb').combogrid('clear');
		$('#nmuskpdb').attr('value','');
		$('#keterangan').attr('value','');
        $('#no_urut').attr('disabled',false);
        $('#uskpd').combogrid('enable');
        $('#uskpdb').combogrid('enable');
        $('#nomor_bukti').attr('value','');
        updt = 'f';
        $('#c_simpan').linkbutton('enable');
        $('#tambah_detail').linkbutton('enable');
        $('#hapus_det').linkbutton('enable');
        
    }
	
    function kosong2(){
        $('#kib').combogrid('clear');
        $('#kib').combogrid('grid').datagrid('reload');
        //load_kib_kosong();
        $('#trd_mutasi').datagrid('loadData', {"total":0,"rows":[]});
        load_kib();
        
      }
        
    function keluar(){
		 swal({
					title: "Jangan lupa disimpan.!!",
					type:"warning"
					});
        $("#dialog-modal").dialog('close');
        //$('#trd2').datagrid('reload');

    }   

    function cek(){
        var skpd_baru  = $('#uskpdb').combobox('getValue');
        var skpd_lama  = $('#uskpd').combobox('getValue');

        if(skpd_baru==skpd_lama){
            var tny = confirm("Apakah Anda Yakin Kode OPD Sama?");
            if(tny==true){
                simpan();
            }else{
                exit();
            }
        }else{
            simpan();
        }
    }
   
    function simpan(){

		var cno_urut   = document.getElementById('no_urut').value;
        var	ctgl_muts  = $('#tanggal').datebox('getValue');
        var unit_baru  = document.getElementById('skpdx').value; 
        var	skpd_baru  = $('#uskpdb').combobox('getValue');
        var nmskpd_br  = document.getElementById('nmuskpdb').value;
        var	skpd_lama  = $('#uskpd').combobox('getValue');
        var nmskpd_lm  = document.getElementById('nmuskpd').value;
        var unit_lama  = document.getElementById('skpd').value;
        var	cket       = document.getElementById('keterangan').value;
		var no_bukti   = document.getElementById('nomor_bukti').value;
        if (skpd_baru == ''){
            alert('OPD Tujuan Tidak Boleh Kosong');
            exit();              
        }if (skpd_lama == ''){
            alert('OPD Tidak Boleh Kosong');
            exit();              
        }if (ctgl_muts == ''){
            alert('Tanggal Usulan Mutasi Tidak Boleh Kosong');
            exit();              
        }

		
         $(document).ready(function(){
            $.ajax({
                type: "POST",       
                dataType : 'json',         
                data: ({tabel:'trh_mutasi',no_bukti:no_bukti,no_mutasi:cno_urut,tanggal:ctgl_muts,skpdb:skpd_baru,unitb:unit_baru,skpdl:skpd_lama,ket:cket,unit_lama:unit_lama,nmskpd_br:nmskpd_br,nmskpd_lm:nmskpd_lm}),
                url: '<?php echo base_url(); ?>index.php/transaksi/simpan_mts_skpd',
                success:function(data){
                status = data.pesan;   
                    if (status=='1'){   
                    simpan_detail();            
                    swal({
					title: "Success!",
					text: "Data Diusulkan Mutasi.!!",
					type: "success",
					confirmButtonText: "OK"
					});
					section1();
                    } else{ 
					swal({
					title: "Error!",
					text: "Gagal Tersimpan.!!",
					type: "error",
					confirmButtonText: "OK"
					});
					exit();
                    }                                                                                                                                       
                }
            });
       }); 
        
        $("#dialog-modal").dialog('close');
    
        /*$('#kib').combogrid({  
            panelWidth:400,  
            width:160,
            idField:'golongan',  
            textField:'nm_golongan',  
            mode:'remote',                                  
            url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
            columns:[[  
               {field:'golongan',title:'Kode Golongan',width:100},  
               {field:'nm_golongan',title:'Nama Golongan',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){ 
              cgol = rowData.golongan;                                
                load_kib();  
            } 
        }); */
    
    
     }


     function simpan_detail(){
        var lctgl       = $('#tanggal').datebox('getValue');
        var nomut_h     = document.getElementById('no_urut').value;
        var skpd_lama   = $('#uskpd').combogrid('getValue');
        var unit_lama   = document.getElementById('skpd').value;
        var nmuskpd     = document.getElementById('nmuskpd').value;
        var unit_baru   = document.getElementById('skpdx').value;
        var skpd_baru   = $('#uskpdb').combogrid('getValue');
        var nmuskpdb_h  = document.getElementById('nmuskpdb').value;
        var ket         = document.getElementById('keterangan').value;
        var riw         = ("Hasil Mutasi dari SKPD "+skpd_lama+"-"+nmuskpd);
        var bukti       = document.getElementById('nomor_bukti').value;
        $('#trd').datagrid('selectAll');
        var rows = $('#trd').datagrid('getSelections');
        var a = [];
        var a1= [];
        var a2= [];
        var a3= [];
        var a4= [];
        var a5= [];
        var a6= [];
        var a7= [];
        var a8= [];
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
        var a97= [];
        var a98= [];

        for(var i=0; i<rows.length; i++){
            a.push(rows[i].no_bukti);
            a1.push(rows[i].nomut);
            a2.push(rows[i].tgl_mut);
            a3.push(rows[i].riwayat);
            a4.push(rows[i].nmuskpdb);
            a5.push(rows[i].no_reg);
            a6.push(rows[i].id_barang);
            a7.push(rows[i].nomor);
            a8.push(rows[i].no_oleh);
            a9.push(rows[i].tgl_reg);
            a10.push(rows[i].tgl_oleh);
            a11.push(rows[i].no_dokumen);
            a12.push(rows[i].kd_brg);
            a13.push(rows[i].nm_brg);
            a14.push(rows[i].detail_brg);
            a15.push(angka(rows[i].nilai));
            a16.push(rows[i].asal);
            a17.push(rows[i].dsr_peroleh);
            a18.push(rows[i].jumlah);
            a19.push(rows[i].total);
            a20.push(rows[i].merek);
            a21.push(rows[i].tipe);
            a22.push(rows[i].pabrik);
            a23.push(rows[i].kd_warna);
            a24.push(rows[i].kd_bahan);
            a25.push(rows[i].kd_satuan);
            a26.push(rows[i].no_rangka);
            a27.push(rows[i].no_mesin);
            a28.push(rows[i].no_polisi);
            a29.push(rows[i].silinder);
            a30.push(rows[i].no_stnk);
            a31.push(rows[i].tgl_stnk);
            a32.push(rows[i].no_bpkb);
            a33.push(rows[i].tgl_bpkb);
            a34.push(rows[i].kondisi);
            a35.push(rows[i].tahun_produksi);
            a36.push(rows[i].dasar);
            a37.push(rows[i].no_sk);
            a38.push(rows[i].tgl_sk);
            a39.push(rows[i].tahun);
            a40.push(rows[i].keterangan);
            a41.push(rows[i].no_mutasi);
            a42.push(rows[i].tgl_mutasi);
            a43.push(rows[i].no_pindah);
            a44.push(rows[i].tgl_pindah);
            a45.push(rows[i].no_hapus);
            a46.push(rows[i].tgl_hapus);
            a47.push(rows[i].kd_ruang);
            a48.push(rows[i].kd_lokasi2);
            a49.push(rows[i].kd_skpd);
            a50.push(rows[i].kd_unit);
            a51.push(rows[i].kd_skpd_lama);
            a52.push(rows[i].milik);
            a53.push(rows[i].wilayah);
            a54.push(rows[i].foto);
            a55.push(rows[i].foto2);
            a56.push(rows[i].foto3);
            a57.push(rows[i].foto4);
            a58.push(rows[i].foto5);
            a59.push(rows[i].no_urut);
            a60.push(rows[i].metode);
            a61.push(rows[i].masa_manfaat);
            a62.push(rows[i].nilai_sisa);
            a63.push(rows[i].kd_riwayat);
            a64.push(rows[i].tgl_riwayat);
            a65.push(rows[i].detail_riwayat);
            a66.push(rows[i].status_tanah);
            a67.push(rows[i].no_sertifikat);
            a68.push(rows[i].tgl_sertifikat);
            a69.push(rows[i].luas);
            a70.push(rows[i].penggunaan);
            a71.push(rows[i].alamat1);
            a72.push(rows[i].alamat2);
            a73.push(rows[i].alamat3);
            a74.push(rows[i].lat);
            a75.push(rows[i].lon);
            a76.push(rows[i].luas_gedung);
            a77.push(rows[i].jenis_gedung);
            a78.push(rows[i].luas_tanah);
            a79.push(rows[i].konstruksi);
            a80.push(rows[i].konstruksi2);
            a81.push(rows[i].luas_lantai);
            a82.push(rows[i].kd_tanah);
            a83.push(rows[i].hibah);
            a84.push(rows[i].panjang);
            a85.push(rows[i].lebar);
            a86.push(rows[i].perolehan);
            a87.push(rows[i].judul);
            a88.push(rows[i].spesifikasi);
            a89.push(rows[i].cipta);
            a90.push(rows[i].tahun_terbit);
            a91.push(rows[i].penerbit);
            a92.push(rows[i].jenis);
            a93.push(rows[i].bangunan);
            a94.push(rows[i].tgl_awal_kerja);
            a95.push(rows[i].nilai_kontrak);
            a96.push(rows[i].kd_golongan);
            a97.push(rows[i].kd_bidang);
            a98.push(rows[i].pemeliharaan_ke);
        }
        //bukti           = (a.push('||'));
        nomut           = (a1.join('||'));
        tgl_mut         = (a2.join('||'));
        riwayat         = (a3.join('||'));
        nmuskpdb        = (a4.join('||'));
        no_reg          = (a5.join('||'));
        id_barang       = (a6.join('||'));
        nomor           = (a7.join('||'));
        no_oleh         = (a8.join('||'));
        tgl_reg         = (a9.join('||'));
        tgl_oleh        = (a10.join('||'));
        no_dokumen      = (a11.join('||'));
        kd_brg          = (a12.join('||'));
        nm_brg          = (a13.join('||'));
        detail_brg      = (a14.join('||'));
        nilai           = (a15.join('||'));
        asal            = (a16.join('||'));
        dsr_peroleh     = (a17.join('||'));
        jumlah          = (a18.join('||'));
        total           = (a19.join('||'));
        merek           = (a20.join('||'));
        tipe            = (a21.join('||'));
        pabrik          = (a22.join('||'));
        kd_warna        = (a23.join('||'));
        kd_bahan        = (a24.join('||'));
        kd_satuan       = (a25.join('||'));
        no_rangka       = (a26.join('||'));
        no_mesin        = (a27.join('||'));
        no_polisi       = (a28.join('||'));
        silinder        = (a29.join('||'));
        no_stnk         = (a30.join('||'));
        tgl_stnk        = (a31.join('||'));
        no_bpkb         = (a32.join('||'));
        tgl_bpkb        = (a33.join('||'));
        kondisi         = (a34.join('||'));
        tahun_produksi  = (a35.join('||'));
        dasar           = (a36.join('||'));
        no_sk           = (a37.join('||'));
        tgl_sk          = (a38.join('||'));
        tahun           = (a39.join('||'));
        keterangan      = (a40.join('||'));
        tgl_mutasi      = (a42.join('||'));
        no_pindah       = (a43.join('||'));
        tgl_pindah      = (a44.join('||'));
        no_hapus        = (a45.join('||'));
        tgl_hapus       = (a46.join('||'));
        kd_ruang        = (a47.join('||'));
        kd_lokasi2      = (a48.join('||'));
        kd_skpd         = (a49.join('||'));
        kd_unit         = (a50.join('||'));
        kd_skpd_lama    = (a51.join('||'));
        milik           = (a52.join('||'));
        wilayah         = (a53.join('||'));
        foto            = (a54.join('||'));
        foto2           = (a55.join('||'));
        foto3           = (a56.join('||'));
        foto4           = (a57.join('||'));
        foto5           = (a58.join('||'));
        no_urut         = (a59.join('||'));
        metode          = (a60.join('||'));
        masa_manfaat    = (a61.join('||'));
        nilai_sisa      = (a62.join('||'));
        kd_riwayat      = (a63.join('||'));
        tgl_riwayat     = (a64.join('||'));
        detail_riwayat  = (a65.join('||'));
        status_tanah    = (a66.join('||'));
        no_sertifikat   = (a67.join('||'));
        tgl_sertifikat  = (a68.join('||'));
        luas            = (a69.join('||'));
        penggunaan      = (a70.join('||'));
        alamat1         = (a71.join('||'));
        alamat2         = (a72.join('||'));
        alamat3         = (a73.join('||'));
        lat             = (a74.join('||'));
        lon             = (a75.join('||'));
        luas_gedung     = (a76.join('||'));
        jenis_gedung    = (a77.join('||'));
        luas_tanah      = (a78.join('||'));
        konstruksi      = (a79.join('||'));
        konstruksi2     = (a80.join('||'));
        luas_lantai     = (a81.join('||'));
        kd_tanah        = (a82.join('||'));
        hibah           = (a83.join('||'));
        panjang         = (a84.join('||'));
        lebar           = (a85.join('||'));
        perolehan       = (a86.join('||'));
        judul           = (a87.join('||'));
        spesifikasi     = (a88.join('||'));
        cipta           = (a89.join('||'));
        tahun_terbit    = (a90.join('||'));
        penerbit        = (a91.join('||'));
        jenis           = (a92.join('||'));
        bangunan        = (a93.join('||'));
        tgl_awal_kerja  = (a94.join('||'));
        nilai_kontrak   = (a95.join('||'));
        kd_golongan     = (a96.join('||'));
        kd_bidang       = (a97.join('||'));
        pemeliharaan_ke = (a98.join('||'));

        $(document).ready(function(){
                $.ajax({
                    type: "POST", 
                    dataType:'json', 
                    url: '<?php echo base_url(); ?>/index.php/transaksi/mutasi_kib',   
                    data: ({bukti           :bukti,
                            nomut           :nomut_h,
                            tgl_mut         :lctgl,
                            riwayat         :riw,
                            nmuskpdb        :nmuskpdb_h,
                            no_reg          :no_reg,
                            id_barang       :id_barang,
                            no              :nomor,
                            no_oleh         :no_oleh,
                            tgl_reg         :tgl_reg,
                            tgl_oleh        :tgl_oleh,
                            no_dokumen      :no_dokumen,
                            kd_brg          :kd_brg,
                            nm_brg          :nm_brg,
                            detail_brg      :detail_brg,
                            nilai           :nilai,
                            asal            :asal,
                            dsr_peroleh     :dsr_peroleh,
                            jumlah          :jumlah,
                            total           :total,
                            merek           :merek,
                            tipe            :tipe,
                            pabrik          :pabrik,
                            kd_warna        :kd_warna,
                            kd_bahan        :kd_bahan,
                            kd_satuan       :kd_satuan,
                            no_rangka       :no_rangka,
                            no_mesin        :no_mesin,
                            no_polisi       :no_polisi,
                            silinder        :silinder,
                            no_stnk         :no_stnk,
                            tgl_stnk        :tgl_stnk,
                            no_bpkb         :no_bpkb,
                            tgl_bpkb        :tgl_bpkb,
                            kondisi         :kondisi,
                            tahun_produksi  :tahun_produksi,
                            dasar           :dasar,
                            no_sk           :no_sk,
                            tgl_sk          :tgl_sk,
                            tahun           :tahun,
                            keterangan      :keterangan,
                            tgl_mutasi      :tgl_mutasi,
                            no_pindah       :no_pindah,
                            tgl_pindah      :tgl_pindah,
                            no_hapus        :no_hapus,
                            tgl_hapus       :tgl_hapus,
                            kd_ruang        :kd_ruang,
                            kd_lokasi2      :kd_lokasi2,
                            kd_skpd         :skpd_baru,
                            kd_unit         :unit_baru,
                            kd_skpd_lama    :skpd_lama,
                            milik           :milik,
                            wilayah         :wilayah,
                            foto            :foto,
                            foto2           :foto2,
                            foto3           :foto3,
                            foto4           :foto4,
                            foto5           :foto5,
                            no_urut         :no_urut,
                            metode          :metode,
                            masa_manfaat    :masa_manfaat,
                            nilai_sisa      :nilai_sisa,
                            kd_riwayat      :kd_riwayat,
                            tgl_riwayat     :tgl_riwayat,
                            detail_riwayat  :detail_riwayat,
                            status_tanah    :status_tanah,
                            no_sertifikat   :no_sertifikat,
                            tgl_sertifikat  :tgl_sertifikat,
                            luas            :luas,
                            penggunaan      :penggunaan,
                            alamat1         :alamat1,
                            alamat2         :alamat2,
                            alamat3         :alamat3,
                            lat             :lat,
                            lon             :lon,
                            luas_gedung     :luas_gedung,
                            jenis_gedung    :jenis_gedung,
                            luas_tanah      :luas_tanah,
                            konstruksi      :konstruksi,
                            konstruksi2     :konstruksi2,
                            luas_lantai     :luas_lantai,
                            kd_tanah        :kd_tanah,
                            hibah           :hibah,
                            panjang         :panjang,
                            lebar           :lebar,
                            perolehan       :perolehan,
                            judul           :judul,
                            spesifikasi     :spesifikasi,
                            cipta           :cipta,
                            tahun_terbit    :tahun_terbit,
                            penerbit        :penerbit,
                            jenis           :jenis,
                            bangunan        :bangunan,
                            tgl_awal_kerja  :tgl_awal_kerja,
                            nilai_kontrak   :nilai_kontrak,
                            kd_golongan     :kd_golongan,
                            kd_bidang       :kd_bidang,
                            pemeliharaan_ke :pemeliharaan_ke
                            
                        })/*,
                    
                    success:function(data){
                        status=data.pesan;
                        if(status=='1'){
                            $('#trd').edatagrid('unselectAll');
                        swal({
                            title: "Berhasil",
                            text: "Data telah disimpan.!!",
                            imageUrl:"<?php echo base_url();?>/lib/images/biak.jpg"
                            });
                            section1();
                            $("#trh").edatagrid("reload");
                        }else{
                            alert('gagal');
                        }   
                    } */                                       
                });
            });

     }

function cari(){
    var kriteria = document.getElementById("cari_brg").value; 
    var ngol 	= $('#kib').combogrid('getValue');
    var cuskpd  = $('#uskpd').combogrid('getValue');
    var unit    = document.getElementById('skpd').value;
    $(function(){
     $('#trd_mutasi').edatagrid({
		url: '<?php echo base_url(); ?>index.php/transaksi/ambil_mutasi',
        queryParams:({cari:kriteria,kdskpd:cuskpd,gol:ngol,unit:unit})
        });        
     });
    }
    
 function load_save(){ 
    var lctgl		= $('#tanggal').datebox('getValue');
    var nomut  		= document.getElementById('no_urut').value;
    var skpd_lama	= $('#uskpd').combogrid('getValue');
    var unit_lama	= document.getElementById('skpd').value;
    var nmuskpd		= document.getElementById('nmuskpd').value;
    var unit_baru	= document.getElementById('skpdx').value;
    var skpd_baru 	= $('#uskpdb').combogrid('getValue');
    var nmuskpdb	= document.getElementById('nmuskpdb').value;
    var keterangan  = document.getElementById('keterangan').value;
    var cgol   		= $('#kib').combogrid('getValue');
	var riwayat 	= ("Hasil Mutasi dari OPD "+skpd_lama+"-"+nmuskpd);
	
    if (skpd_lama == ''){
         alert('OPD Tidak Boleh Kosong');
         exit();              
     } /*if (skpd_baru == ''){
         alert('SKPD Tujuan Tidak Boleh Kosong');
         exit();              
     }*/
    if (lctgl == ''){
         alert('Tanggal Hapus Tidak Boleh Kosong');
         exit();              
     }
    
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
			a10.push(rows[i].nilai);
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
            a93.push(rows[i].kd_golongan);
            a94.push(rows[i].kd_bidang);
            a95.push(rows[i].pemeliharaan_ke);
		}
	 
		no_reg            =(a1.join('||'));
		id_barang         =(a2.join('||'));
		no                =(a3.join('||'));
		no_oleh           =(a4.join('||'));
		tgl_reg           =(a5.join('||'));
		tgl_oleh          =(a6.join('||'));
		no_dokumen        =(a7.join('||'));
		kd_brg            =(a8.join('||'));
		nm_brg            =(a8x.join('||'));
		detail_brg        =(a9.join('||'));
		nilai             =(a10.join('||'));
		asal              =(a11.join('||'));
		dsr_peroleh       =(a12.join('||'));
		jumlah            =(a13.join('||'));
		total             =(a14.join('||'));
		merek             =(a15.join('||'));
		tipe              =(a16.join('||'));
		pabrik            =(a17.join('||'));
		kd_warna          =(a18.join('||'));
		kd_bahan          =(a19.join('||'));
		kd_satuan         =(a20.join('||'));
		no_rangka         =(a21.join('||'));
		no_mesin          =(a22.join('||'));
		no_polisi         =(a23.join('||'));
		silinder          =(a24.join('||'));
		no_stnk           =(a25.join('||'));
		tgl_stnk          =(a26.join('||'));
		no_bpkb           =(a27.join('||'));
		tgl_bpkb          =(a28.join('||'));
		kondisi           =(a29.join('||'));
		tahun_produksi    =(a30.join('||'));
		dasar             =(a31.join('||'));
		no_sk             =(a32.join('||'));
		tgl_sk            =(a33.join('||'));
		keterangan        =(a34.join('||'));
		no_mutasi         =(a35.join('||'));
		tgl_mutasi        =(a36.join('||'));
		no_pindah         =(a37.join('||'));
		tgl_pindah        =(a38.join('||'));
		no_hapus          =(a39.join('||'));
		tgl_hapus         =(a40.join('||'));
		kd_ruang          =(a41.join('||'));
		kd_lokasi2        =(a42.join('||'));
		kd_skpd           =(a43.join('||')); 
		kd_unit           =(a44.join('||')); 
		kd_skpd_lama      =(a45.join('||')); 
		milik             =(a46.join('||'));
		wilayah           =(a47.join('||'));
		username          =(a48.join('||'));
		tgl_update        =(a49.join('||'));
		tahun             =(a50.join('||'));
		foto              =(a51.join('||'));
		foto2             =(a52.join('||'));
		foto3             =(a53.join('||'));
		foto4             =(a54.join('||'));
		foto5             =(a55.join('||'));
		no_urut           =(a56.join('||'));
		metode            =(a57.join('||'));
		masa_manfaat      =(a58.join('||'));
		nilai_sisa        =(a59.join('||'));
		kd_riwayat        =(a60.join('||'));
		tgl_riwayat       =(a61.join('||'));
		detail_riwayat    =(a62.join('||'));
		status_tanah      =(a63.join('||'));
		no_sertifikat     =(a64.join('||'));
		tgl_sertifikat    =(a65.join('||'));
		luas              =(a66.join('||'));
		penggunaan        =(a67.join('||'));
		alamat1           =(a68.join('||'));
		alamat2           =(a69.join('||'));
		alamat3           =(a70.join('||'));
		lat               =(a71.join('||'));
		lon               =(a72.join('||'));
		luas_gedung       =(a73.join('||'));
		jenis_gedung      =(a74.join('||'));
		luas_tanah        =(a75.join('||'));
		konstruksi        =(a76.join('||'));
		konstruksi2       =(a77.join('||'));
		luas_lantai       =(a78.join('||'));
		kd_tanah          =(a79.join('||'));
		hibah             =(a80.join('||'));
		panjang           =(a81.join('||'));
		lebar             =(a82.join('||'));
		perolehan         =(a83.join('||'));
		judul             =(a84.join('||'));
		spesifikasi       =(a85.join('||'));
		cipta             =(a86.join('||'));
		tahun_terbit      =(a87.join('||'));
		penerbit          =(a88.join('||'));
		jenis             =(a89.join('||'));
		bangunan          =(a90.join('||'));
		tgl_awal_kerja    =(a91.join('||'));
		nilai_kontrak     =(a92.join('||'));
        kd_golongan       =(a93.join('||'));
        kd_bidang         =(a94.join('||'));
        pemeliharaan_ke   =(a95.join('||'));

    if (no == ''){
         alert('Barang Yang Akan DIUSULKAN MUTASI Belum Dipilih');
         exit();              
     }
    var r = confirm("Yakin ingin Diusulkan Mutasi Barang: "+kd_brg+" ?");
    if(r==true){
         $('#usul').linkbutton('disable');
         $.ajax({
            type: 'POST',
            data: ({
                nomut           :nomut,
                tgl_mut         :lctgl,
                riwayat         :riwayat,
                nmuskpdb        :nmuskpdb,
                no_reg          :no_reg,
                id_barang       :id_barang,
                no              :no,
                no_oleh         :no_oleh,
                tgl_reg         :tgl_reg,
                tgl_oleh        :tgl_oleh,
                no_dokumen      :no_dokumen,
                kd_brg          :kd_brg,
                nm_brg          :nm_brg,
                detail_brg      :detail_brg,
                nilai           :nilai,
                asal            :asal,
                dsr_peroleh     :dsr_peroleh,
                jumlah          :jumlah,
                total           :total,
        		merek           :merek,
                tipe            :tipe,
                pabrik          :pabrik,
                kd_warna        :kd_warna,
                kd_bahan        :kd_bahan,
                kd_satuan       :kd_satuan,
                no_rangka       :no_rangka,
                no_mesin        :no_mesin,
                no_polisi       :no_polisi,
                silinder        :silinder,
                no_stnk         :no_stnk,
                tgl_stnk        :tgl_stnk,
                no_bpkb         :no_bpkb,
        		tgl_bpkb        :tgl_bpkb,
                kondisi         :kondisi,
                tahun_produksi  :tahun_produksi,
                dasar           :dasar,
                no_sk           :no_sk,
                tgl_sk          :tgl_sk,
                keterangan      :keterangan,
                no_mutasi       :no_mutasi,
                tgl_mutasi      :tgl_mutasi,
                no_pindah       :no_pindah,
                tgl_pindah      :tgl_pindah,
        		no_hapus        :no_hapus,
                tgl_hapus       :tgl_hapus,
                kd_ruang        :kd_ruang,
                kd_lokasi2      :kd_lokasi2,
                kd_skpd         :skpd_baru,
                kd_unit         :unit_baru,
                kd_skpd_lama    :skpd_lama,
                milik           :milik,
                wilayah         :wilayah,
                tahun           :tahun,
                foto            :foto,
                foto2           :foto2,
                foto3           :foto3,
                foto4           :foto4,
                foto5           :foto5,
                no_urut         :no_urut,
                metode          :metode,
                masa_manfaat    :masa_manfaat,
                nilai_sisa      :nilai_sisa,
                kd_riwayat      :kd_riwayat,
                tgl_riwayat     :tgl_riwayat,
        		detail_riwayat  :detail_riwayat,
                status_tanah    :status_tanah,
                no_sertifikat   :no_sertifikat,
                tgl_sertifikat  :tgl_sertifikat,
                luas            :luas,
                penggunaan      :penggunaan,
                alamat1         :alamat1,
                alamat2         :alamat2,
                alamat3         :alamat3,
        		lat             :lat,
                lon             :lon,
                luas_gedung     :luas_gedung,
                jenis_gedung    :jenis_gedung,
                luas_tanah      :luas_tanah,
                konstruksi      :konstruksi,
                konstruksi2     :konstruksi2,
                luas_lantai     :luas_lantai,
                kd_tanah        :kd_tanah,
        		hibah           :hibah,
                panjang         :panjang,
                lebar           :lebar,
                perolehan       :perolehan,
                judul           :judul,
                spesifikasi     :spesifikasi,
        		cipta           :cipta,
                tahun_terbit    :tahun_terbit,
                penerbit        :penerbit,
                jenis           :jenis,
                bangunan        :bangunan,
                tgl_awal_kerja  :tgl_awal_kerja,
                nilai_kontrak   :nilai_kontrak,
                kd_golongan     :kd_golongan,
                kd_bidang       :kd_bidang,
                pemeliharaan_ke :pemeliharaan_ke
            }),
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/transaksi/mutasi_kib",
			success:function(data){ 
			loadDetail();
            load_kib(); 
			$('#trd_mutasi').edatagrid('reload');  
			swal({
				title: "Data Telah Diusulkan Dimutasi!",
				type: "info",
				confirmButtonText: "OK"
				});
            $('#usul').linkbutton('enable');
			}
         });
    }              
    
}	


function append_save(){

    var lctgl       = $('#tanggal').datebox('getValue');
    var nomut       = document.getElementById('no_urut').value;
    var skpd_lama   = $('#uskpd').combogrid('getValue');
    var unit_lama   = document.getElementById('skpd').value;
    var nmuskpd     = document.getElementById('nmuskpd').value;
    var unit_baru   = document.getElementById('skpdx').value;
    var skpd_baru   = $('#uskpdb').combogrid('getValue');
    var nmuskpdb    = document.getElementById('nmuskpdb').value;
    var keterangan  = document.getElementById('keterangan').value;
    var cgol        = $('#kib').combogrid('getValue');
    var riwayat     = ("Hasil Mutasi dari OPD "+skpd_lama+"-"+nmuskpd);
    $('#trd').datagrid('selectAll');
              var rows = $('#trd').datagrid('getSelections');
              jgrid = rows.length ;

              if(updt='t'){
                    pidx = jgrid ;
                    pidx = pidx + 1 ;
                  }else if(updt='f'){
                    pidx = pidx + 1 ;
                  }
var rows = $('#trd_mutasi').edatagrid('getSelections'); 
        for( i=0; i < rows.length; i++){ 
            no_reg          = rows[i].no_reg;
            id_barang       = rows[i].id_barang;
            nomor           = rows[i].nomor;
            no_oleh         = rows[i].no_oleh;
            tgl_reg         = rows[i].tgl_reg;
            tgl_oleh        = rows[i].tgl_oleh;
            no_dokumen      = rows[i].no_dokumen;
            kd_brg          = rows[i].kd_brg;
            nm_brg          = rows[i].nm_brg;
            detail_brg      = rows[i].detail_brg;
            nilai           = rows[i].nilai;
            asal            = rows[i].asal;
            dsr_peroleh     = rows[i].dsr_peroleh;
            jumlah          = rows[i].jumlah;
            total           = rows[i].total;
            merek           = rows[i].merek;
            tipe            = rows[i].tipe;
            pabrik          = rows[i].pabrik;
            kd_warna        = rows[i].kd_warna;
            kd_bahan        = rows[i].kd_bahan;
            kd_satuan       = rows[i].kd_satuan;
            no_rangka       = rows[i].no_rangka;
            no_mesin        = rows[i].no_mesin;
            no_polisi       = rows[i].no_polisi;
            silinder        = rows[i].silinder;
            no_stnk         = rows[i].no_stnk;
            tgl_stnk        = rows[i].tgl_stnk;
            no_bpkb         = rows[i].no_bpkb;
            tgl_bpkb        = rows[i].tgl_bpkb;
            kondisi         = rows[i].kondisi;
            tahun_produksi  = rows[i].tahun_produksi;
            dasar           = rows[i].dasar;
            no_sk           = rows[i].no_sk;
            tgl_sk          = rows[i].tgl_sk;
            keterangan      = rows[i].keterangan;
            no_mutasi       = rows[i].no_mutasi;
            tgl_mutasi      = rows[i].tgl_mutasi;
            no_pindah       = rows[i].no_pindah;
            tgl_pindah      = rows[i].tgl_pindah;
            no_hapus        = rows[i].no_hapus;
            tgl_hapus       = rows[i].tgl_hapus;
            kd_ruang        = rows[i].kd_ruang;
            kd_lokasi2      = rows[i].kd_lokasi2;
            kd_skpd         = rows[i].kd_skpd;
            kd_unit         = rows[i].kd_unit;
            kd_skpd_lama    = rows[i].kd_skpd_lama;
            milik           = rows[i].milik;
            wilayah         = rows[i].wilayah;
            tahun           = rows[i].tahun;
            foto            = rows[i].foto;
            foto2           = rows[i].foto2;
            foto3           = rows[i].foto3;
            foto4           = rows[i].foto4;
            foto5           = rows[i].foto5;
            no_urut         = rows[i].no_urut;
            metode          = rows[i].metode;
            masa_manfaat    = rows[i].masa_manfaat;
            nilai_sisa      = rows[i].nilai_sisa;
            kd_riwayat      = rows[i].kd_riwayat;
            tgl_riwayat     = rows[i].tgl_riwayat;
            detail_riwayat  = rows[i].detail_riwayat;
            status_tanah    = rows[i].status_tanah;
            no_sertifikat   = rows[i].no_sertifikat;
            tgl_sertifikat  = rows[i].tgl_sertifikat;
            luas            = rows[i].luas;
            penggunaan      = rows[i].penggunaan;
            alamat1         = rows[i].alamat1;
            alamat2         = rows[i].alamat2;
            alamat3         = rows[i].alamat3;
            lat             = rows[i].lat;
            lon             = rows[i].lon;
            luas_gedung     = rows[i].luas_gedung;
            jenis_gedung    = rows[i].jenis_gedung;
            luas_tanah      = rows[i].luas_tanah;
            konstruksi      = rows[i].konstruksi;
            konstruksi2     = rows[i].konstruksi2;
            luas_lantai     = rows[i].luas_lantai;
            kd_tanah        = rows[i].kd_tanah;
            hibah           = rows[i].hibah;
            panjang         = rows[i].panjang;
            lebar           = rows[i].lebar;
            perolehan       = rows[i].perolehan;
            judul           = rows[i].judul;
            spesifikasi     = rows[i].spesifikasi;
            cipta           = rows[i].cipta;
            tahun_terbit    = rows[i].tahun_terbit;
            penerbit        = rows[i].penerbit;
            jenis           = rows[i].jenis;
            bangunan        = rows[i].bangunan;
            tgl_awal_kerja  = rows[i].tgl_awal_kerja;
            nilai_kontrak   = rows[i].nilai_kontrak;
            kd_golongan     = rows[i].kd_golongan;
            kd_bidang       = rows[i].kd_bidang;
            pemeliharaan_ke = rows[i].pemeliharaan_ke;

            

            $('#trd').datagrid('appendRow',{
                idx             :pidx,
                nomut           :nomut,
                tgl_mut         :lctgl,
                riwayat         :riwayat,
                nmuskpdb        :nmuskpdb,
                no_reg          :no_reg,
                id_barang       :id_barang,
                nomor           :nomor,
                no_oleh         :no_oleh,
                tgl_reg         :tgl_reg,
                tgl_oleh        :tgl_oleh,
                no_dokumen      :no_dokumen,
                kd_brg          :kd_brg,
                nm_brg          :nm_brg,
                detail_brg      :detail_brg,
                nilai           :nilai,
                asal            :asal,
                dsr_peroleh     :dsr_peroleh,
                jumlah          :jumlah,
                total           :total,
                merek           :merek,
                tipe            :tipe,
                pabrik          :pabrik,
                kd_warna        :kd_warna,
                kd_bahan        :kd_bahan,
                kd_satuan       :kd_satuan,
                no_rangka       :no_rangka,
                no_mesin        :no_mesin,
                no_polisi       :no_polisi,
                silinder        :silinder,
                no_stnk         :no_stnk,
                tgl_stnk        :tgl_stnk,
                no_bpkb         :no_bpkb,
                tgl_bpkb        :tgl_bpkb,
                kondisi         :kondisi,
                tahun_produksi  :tahun_produksi,
                dasar           :dasar,
                no_sk           :no_sk,
                tgl_sk          :tgl_sk,
                keterangan      :keterangan,
                no_mutasi       :no_mutasi,
                tgl_mutasi      :tgl_mutasi,
                no_pindah       :no_pindah,
                tgl_pindah      :tgl_pindah,
                no_hapus        :no_hapus,
                tgl_hapus       :tgl_hapus,
                kd_ruang        :kd_ruang,
                kd_lokasi2      :kd_lokasi2,
                kd_skpd         :kd_skpd,
                kd_unit         :kd_unit,
                kd_skpd_lama    :skpd_lama,
                milik           :milik,
                wilayah         :wilayah,
                tahun           :tahun,
                foto            :foto,
                foto2           :foto2,
                foto3           :foto3,
                foto4           :foto4,
                foto5           :foto5,
                no_urut         :no_urut,
                metode          :metode,
                masa_manfaat    :masa_manfaat,
                nilai_sisa      :nilai_sisa,
                kd_riwayat      :kd_riwayat,
                tgl_riwayat     :tgl_riwayat,
                detail_riwayat  :detail_riwayat,
                status_tanah    :status_tanah,
                no_sertifikat   :no_sertifikat,
                tgl_sertifikat  :tgl_sertifikat,
                luas            :luas,
                penggunaan      :penggunaan,
                alamat1         :alamat1,
                alamat2         :alamat2,
                alamat3         :alamat3,
                lat             :lat,
                lon             :lon,
                luas_gedung     :luas_gedung,
                jenis_gedung    :jenis_gedung,
                luas_tanah      :luas_tanah,
                konstruksi      :konstruksi,
                konstruksi2     :konstruksi2,
                luas_lantai     :luas_lantai,
                kd_tanah        :kd_tanah,
                hibah           :hibah,
                panjang         :panjang,
                lebar           :lebar,
                perolehan       :perolehan,
                judul           :judul,
                spesifikasi     :spesifikasi,
                cipta           :cipta,
                tahun_terbit    :tahun_terbit,
                penerbit        :penerbit,
                jenis           :jenis,
                bangunan        :bangunan,
                tgl_awal_kerja  :tgl_awal_kerja,
                nilai_kontrak   :nilai_kontrak,
                kd_golongan     :kd_golongan,
                kd_bidang       :kd_bidang,
                pemeliharaan_ke :pemeliharaan_ke
            });
            $('#trd').datagrid('unselectAll');
        }

        keluar();

    
}

	
	  function hapus_usulan(){
        var rows = $('#trh').datagrid('getSelected');
        var no_mutasi   = rows.no_mutasi; 
        var skpdb       = rows.kd_skpd; 
        var unitb       = rows.kd_unit; 
        var kd_skpd_lama= rows.kd_skpd_lama; 
        var kd_unit_lama= rows.kd_unit_lama; 
        var sts         = rows.sts;//alert(sts);
        var bukti       = rows.no_bukti; alert(bukti);
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_mutasi';
        if(sts=='DISETUJUI'){
            sweetAlert("Tidak Dapat Dihapus", "Data Telah Di Lakukan Penetepan", "error");
            $('#trh').datagrid('reload');
            exit();
        }else if(sts=='DITOLAK'){
            sweetAlert("Tidak Dapat Dihapus", "Data Telah Di Lakukan Penetepan", "error");
            $('#trh').datagrid('reload');
            exit();
        }else{
        

        swal({
              title:"Apakah Anda Yakin Ingin Menghapus Data" ,
              text:"Hapus Data "+no_mutasi+"?",
              type: "warning",
              html:true,
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya",
              cancelButtonText: "Tidak",
              closeOnConfirm: true,
              closeOnCancel: true
            },
function(isConfirm){
  
  $(document).ready(function(){
         $.post(
         urll,({tabel:'trh_mutasi',cnid:no_mutasi,cid:'no_mutasi',skpd:skpdb,unit:unitb,skpd_lama:kd_skpd_lama,unit_lama:kd_unit_lama,bukti:bukti}),
         function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                sweetAlert("Berhasil...!!!", "Data Telah Di Hapus", "success");
                $('#trh').datagrid('reload'); 
                exit();
            }
         });
        });    
      });

    }

        
    } 
	 
	/*function hapus_detail(){
		var rows = $('#trd').datagrid('getSelected');
        var id_barang = rows.id_barang;
        var no_mutasi = rows.no_mutasi;
        var kd_skpd = rows.kd_skpd;
        var kd_unit = rows.kd_unit;
        var auto = rows.auto; 
    if (no_mutasi !=''){
		var del=confirm('Apakah Anda yakin ingin Menhapus Rincian Data '+id_barang+'?');
		if (del==true){          
        var urll = '<?php echo base_url(); ?>index.php/transaksi/hapus_detail';
        $(document).ready(function(){
         $.post(
		 urll,({tabel:'trd_mutasi',cnid:no_mutasi,id:id_barang,cid:'no_mutasi',skpd:kd_skpd,urut:auto,unit:kd_unit}),
		 function(data){
            status = data;
            if (status=='0'){
                alert('Gagal Hapus..!!');
                exit();
            } else {
                $('#trd').datagrid('deleteRow',lcidx); 
                exit();
            }
         });
        });    }}
    }*/
function hapus_detail(){
      var rows  = $('#trd').datagrid('getSelected');
      var cdk   =   rows.no_dokumen;
      var crk   =   rows.kd_brg;
      var nrk   =   rows.nm_brg;
      var cnil  =   rows.nilai;
       
      var idx   = $('#trd').datagrid('getRowIndex',rows);
      var tny   = confirm('Yakin Ingin Menghapus Data, No.Dokumen : '+cdk+' Nama Barang : '+nrk+' Nilai : '+cnil);
      if (tny==true){
          $('#trd').datagrid('deleteRow',idx);  
       }else if(tny==false){
          $('#trd').datagrid('unselectAll');
       }                     
}

function ambil_nomor(){
        var tab = 'trh_mutasi';
        //var skpd = $('#uskpd').combogrid('getValue');
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>/index.php/master/max_nomor',
            data: ({tabel:tab}),
            dataType:"json",
                success: function(data){
                $("#nomor_bukti").attr("value",data.nomor)
            }
        });
    }

function set_grid(){
        $('#trd').edatagrid({  
            columns:[[
                {field:'id',
            title:'ID',       
                hidden:"true"},
                {field:'no_sts',
            title:'No STS',       
                hidden:"true"}, 
            {field:'no_terima',
            title:'Nomor Terima',
                width:2} ,              
              {field:'kd_rek5',
            title:'Nomor Rekening',
                width:2},
                {field:'nm_rek',
            title:'Nama Rekening',
                width:4},                
                {field:'rupiah',
            title:'Rupiah',
                align:'right',
                width:2}                
                
            ]]
        });    
    }

function cari2(xx){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#trh').edatagrid({
        url: '<?php echo base_url(); ?>/index.php/transaksi/ambil_mutasi_head',
        queryParams:({cari:xx})
        });        
     });
    }
    
   </script>


<div id="tabs" >
		<p><h3 align="center">USULAN MUTASI BARANG</h3></p>
    <ul style="background-color:#2da305;">
        <li><a href="#tabs-1" style="width: 452px;" id="tabs1">List View</a></li>
        <li><a href="#tabs-2" style="width: 452px;" id="tabs2">Form Input</a></li> 		
    </ul>
    <div id="tabs-1">
        <div>
            <p align="right">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();section2();">Tambah</a>
                <a plain="false">Cari</a>
                <input id="txtcari" class="easyui-searchbox" data-options="prompt:'Please Input Value',searcher:function(value,name){cari2(value)}" style="width:190px"/>
                <!--a class="easyui-linkbutton" iconCls="icon-search" plain="true" >Cari</a>
                <input type="text" value="" id="txtcari"/-->
                </p>
                <p>              
                <table  id="trh" title="List Usulan Mutasi" style="width:940px;height:400px;" >  
                </table> <br/>               
            </p>
        </div>
		<!--div align="center" style="width: 1600px;"> <a class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:load_hapus()">HAPUS USULAN</a></div-->		

    </div>
    <div id="tabs-2">  
        <br /><br />
        <table >
            <tr>
                <td height="10px" width="100px">NO. Bukti</td>
                <td>:</td>
                <td><input id="nomor_bukti" name="nomor_bukti" style="width: 130px;" placeholder="AutoNumber" disabled="true"/></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>     
            </tr>
            <tr>
                <td height="10px" width="100px">NO. B.A Mutasi</td>
                <td>:</td>
                <td><input placeholder="*isi No B.A usulan Mutasi" type="text" id="no_urut" style="width: 160px;" onclick="javascript:select();" /></td>
                <td width="30px"></td>
                <td width="100px">Tgl B.A Mutasi</td>
                <td>:</td>
                <td height="10px"><input type="text" id="tanggal" style="width: 140px;" /></td>     
            </tr>
            <tr>
                <td height="30px">OPD</td>
                <td>:</td>
                <td><input id="uskpd" name="uskpd" style="width: 160px;" /></td>
                <td></td>
                <td>Nama OPD</td> 
                <td>:</td>
                <td><input type="text" id="nmuskpd" style="border:0;width: 400px;" readonly="true"/>
				<input type="text" id="skpd" style="border:1;width: 400px;" hidden="true"/></td>                                
            </tr>
            <tr>
                <td height="30px">Alasan Mutasi</td>
                <td>:</td>
                <td><textarea id="keterangan" name="keterangan" style="width: 250px;" ></textarea></td>
                <td></td>
				<td>OPD Baru</td>
                <td>:</td>
                <td><input type="text" id="uskpdb" style="width: 140px;" />
				<input type="text" id="nmuskpdb" style="border:0;width: 400px;" readonly="true"/>
				<input type="text" id="skpdx" style="width: 140px;" hidden="true"/></td>                               
            </tr> 
		</table><br/>    
		<div align="center">
        <fieldset>
        
        <table>
            <tr>
                <td>
                    <a class="easyui-linkbutton" id="c_simpan" name="c_simpan" iconCls="icon-save" plain="false" onclick="javascript:cek();">Simpan</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section1();">Keluar</a>
                </td>
            </tr>
        </table>
        </fieldset>
        </div>  
		<br/> 
        <table  id="trd" title="Detail Usulan Barang Mutasi" style="width:940px;height:300px;" > 
        <div id="toolbar" align="right">             
        <a id="tambah_detail" name="tambah_detail" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah_detail();">Tambah Brg Mutasi</a> 
        <a id="hapus_det" name="hapus_det" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus_detail();">Hapus Detail</a>                                            
        </div> 
        </table>
        <br/>   
        <!-- div align="right">Total : <input type="text" id="total" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></div> 
        <div align="center" style="width: 1600px;"> <a class="easyui-linkbutton" iconCls="icon-ok" plain="true" onclick="javascript:load_save()">USULKAN MUTASI</a></div		
        <br />
        <!-- <div align="center">
		<fieldset>
		<INPUT TYPE="button" VALUE="SIMPAN" style="height:40px;width:100px" onclick="javascript:simpan();" >
		<INPUT TYPE="button" VALUE="KEMBALI" style="height:40px;width:100px" onclick="javascript:section1();" >
        </fieldset>
		</div> -->  -->
    </div>  
</div>

<div id="dialog-modal" title="PILIH BARANG YANG AKAN DIMUTASI">
    <fieldset>  
		<div> 
		<table>  
			<tr>
                <td height="30px">PILIH KIB USULAN MUTASI</td>
                <td>:</td>
                <td><input id="kib" name="kib" style="width: 250px;" /></td>
                <td colspan="4"></td>
			</tr> 
		</table>
		<table>
			<tr>
				<td colspan="2"><input placeholder="*cari nama aset" type="text" value="" id="cari_brg" style="width: 250px;" /></td>  
				<td > <a class="easyui-linkbutton" iconCls="icon-file_search" plain="false" onclick="javascript:cari();" ></a></td>
			</tr>                         
        </table>  
        <br/>
        <table  id="trd_mutasi" title="PILIH BARANG" style="width:950px;height:360px;" >  
        </table><br/> 
    <fieldset>
        <table align="center">
            <tr>
                <td><a id="usul" class="easyui-linkbutton" iconCls="icon-ok" plain="false" onclick="javascript:append_save();">USULKAN MUTASI</a>
                    <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">KEMBALI</a>                               
                </td>
            </tr>
        </table>   
    </fieldset>		
    </div>  
    </fieldset>
</div>


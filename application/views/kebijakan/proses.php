    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="<?php echo base_url(); ?>lib/sweet-alert.min.js"></script>
	<link   rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>lib/sweet-alert.css">
	<script type="text/javascript">
    
    var kdwil= '';
    var judul= '';
    var cid = 0;
    var lcidx = 0;
    var lcstatus = '';
    var ctk2='';
                    
    function opt(val){       
        del = val; 
        $("#hps").attr("value",del);
	}
	
	function opt1(val){        
        ctk = val;
        if (ctk=='1'){
            $("#pilihancetak").show();
            $('input[name="cetak2"]').prop('checked', false);
            $('#tahun1').combogrid('clear');
            $('#tahun2').combogrid('clear');
            $('#bulan').combogrid('clear');
            $('#tahun').combogrid('clear');
            $("#skpd").show();
            $("#div_skpd").hide();
            $("#model_ctk").hide();
            $("#div_bulan").hide();
            $("#div_tahun").hide();
            $("#div_tahunsd").hide();
            $("#div_jenis").hide();
        } else if (ctk=='2'){
            $("#pilihancetak").show();
            $('input[name="cetak2"]').prop('checked', false);
            $('#tahun1').combogrid('clear');
            $('#tahun2').combogrid('clear');
            $('#bulan').combogrid('clear');
            $('#tahun').combogrid('clear');
            $("#skpd").show();
            $("#div_skpd").show();
            $("#model_ctk").hide();
            $("#div_tahunsd").hide();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").hide();
        } else if (ctk=='3'){
            $("#skpd").show();
            $("#div_skpd").hide();
            $("#model_ctk").hide();
            $("#div_tahunsd").show();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").show();
		}else if (ctk==''){
            $("#skpd").hide();
            $("#div_skpd").hide();
            $("#model_ctk").hide();
            $("#div_tahunsd").hide();
            $("#div_tahun").hide();
            $("#div_bulan").hide();
            $("#div_jenis").hide();
    }else {
            exit();
        }      
			//openWindow();
    }
	
    function kosong(){
        $("#kdmilik").attr("value",'');
        $("#nmmilik").attr("value",''); 
    }
	
	
    $(document).ready(function() {
          $("#skpd").hide();
          $("#div_skpd").hide();
          $("#div_tahunsd").hide();
          $("#div_tahun").hide();
          $("#div_bulan").hide();
          $("#nmskpd").attr("value",'');
          $("#model_ctk").hide();
          $("#div_jenis").hide();
          $("#div_bend").hide();
          $("#pilihancetak").hide();
          $("#nmbidskpd").attr("value",'');
          tahun();
          tahun1();
          tahun2();
          bulan();
    });
    
	$(function(){
/* 	$('#kib').combogrid({  
		panelWidth:630,  
        width:50,
		idField:'golongan',  
		textField:'golongan',  
		mode:'remote',
		url:'<?php echo base_url(); ?>index.php/master/ambil_gol',  
		columns:[[  
			{field:'golongan',title:'Kode',width:100},  
			{field:'nm_golongan',title:'Nama',width:500}    
		]],
		onSelect:function(rowIndex,rowData){
			kdskpd = rowData.kd_skpd;
			$("#nmkib").attr("value",rowData.nm_golongan.toUpperCase());

           
		}  
		}); */ 
		
		$('#kib').combobox({           
        valueField:'kode',  
        textField:'nama',
        width:300,
        data:[{kode:'02',nama:'KIB B | PERALATAN DAN MESIN'},{kode:'03',nama:'KIB C | GEDUNG DAN BANGUNAN'},{kode:'04',nama:'KIB D | JALAN JARINGAN DAN IRIGASI'},{kode:'05',nama:'KIB E | ASET TETAP LAINNYA'},{kode:'07',nama:'ASET LAINNYA'}]
    });
		
	});
	
	function proses_susut(){
		var hps 	= document.getElementById('hps').value;
		//var kib 	= $("#kib").combobox("getValue");
		//var cskpd 	= $("#kdubidskpd").combogrid("getValue");
		//var mlokasi	= document.getElementById('kdlokasi').value;
		//var ctahun 	= $("#tahun").combobox("getValue");
		
    var blnthn  = ctk2;
	var kib 	= $("#kib").combobox("getValue");
    var cskpd   = $('#kdskpd').combogrid('getValue'); 
    var tahun   = $('#tahun').combogrid('getValue');//$('#tahun').combogrid('getValue');
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
	var mlokasi	= "";//document.getElementById('kdlokasi').value;
    var cbid1   = $('#kdubidskpd').combogrid('getValue');
    var cnm_bid = document.getElementById('nmbidskpd').value;
    var pilihan = document.getElementById('pilihancetak').value;
    var bulan   = $('#bulan').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 
    //var funit 	= document.getElementById('funit').value; 
	
	if(cbid1==''){
    var cbid   = document.getElementById('funit').value; 
	}else{
    var cbid   = $('#kdubidskpd').combogrid('getValue');
	}	
	alert(cbid);
	if(bulan!=''){
	var tabel2 ="cek_posting_susut_tgl"; 
		if(kib=='02'){
		var tabel = "kibb_susut_tgl";
		}else if(kib=='03'){
		var tabel = "kibc_susut_tgl";
		}else if(kib=='04'){
		var tabel = "kibd_susut_tgl";
		}else if(kib=='05'){
		var tabel = "kibe_susut_tgl";
		}else{
		var tabel = "kibg_susut_tgl";
		}
	}else{
	var tabel2 ="cek_posting_susut"; 	
		if(kib=='02'){
		var tabel = "kibb_susut";
		}else if(kib=='03'){
		var tabel = "kibc_susut";
		}else if(kib=='04'){
		var tabel = "kibd_susut";
		}else if(kib=='05'){
		var tabel = "kibe_susut";
		}else{
		var tabel = "kibg_susut";
		}
	}
		if ( kib == '' ){
            alert('Pilih KIB Terlebih Dahulu...!!!');
            exit();
        }
        
        if ( kib == '01'){
            swal("Oops...", "KIB A Tidak Di susutkan!", "error");
			exit();			
        }
		if ( kib == '06'){
            swal("Oops...", "KIB F Tidak Di susutkan!", "error");
			exit();			
        }
		
		document.getElementById('load').style.visibility='visible';
		$(function(){     
		 $.ajax({
			type: 'POST',
			data: ({hps:hps,blnthn:blnthn,kib:kib,skpd:cskpd,tahun:tahun,tahun1:tahun1,tahun2:tahun2,tabel:tabel,tabel2:tabel2,unit:cbid,cnmskpd:cnmskpd,nm_unit:cnm_bid,pilihan:pilihan,bulan:bulan,lctgl2:lctgl2,jenis:jenis,nmjenis:nmjenis}),
			dataType:"json",
			url:"<?php echo base_url(); ?>index.php/laporan_kebijakan/proses_susut",
			success:function(data){
				if (data == '1'){
					swal("Good job!", "Proses Penyusutan selesai !!", "success");
				}else{
					swal("Oops...", "Sudah dilakukan Proses Penyusutan!", "error");				
				}
				
					document.getElementById('load').style.visibility='hidden';
			}
		 });
		});
		
	}
	
	
	function proses_jurnal(){
		var hps 	= document.getElementById('hps').value;
		var mlokasi	= document.getElementById('kdlokasi').value;
		var kib 	= $("#kib").combobox("getValue");
		var cskpd 	= $("#kdubidskpd").combogrid("getValue");
		var ctahun 	= $("#tahun").combobox("getValue");
		var bulan   = $('#bulan').combogrid('getValue');
		if(bulan!=''){
		if(kib=='02'){
		var tabel = "kibb_susut_tgl";
		var fkib   = "kibb";
		}else if(kib=='03'){
		var tabel = "kibc_susut_tgl";
		var fkib   = "kibc";
		}else if(kib=='04'){
		var tabel = "kibd_susut_tgl";
		var fkib   = "kibd";
		}else{
		var tabel = "kibe_susut_tgl";
		var fkib   = "kibe";
		}
		}else{
		if(kib=='02'){
		var tabel = "kibb_susut";
		var fkib   = "kibb";
		}else if(kib=='03'){
		var tabel = "kibc_susut";
		var fkib   = "kibc";
		}else if(kib=='04'){
		var tabel = "kibd_susut";
		var fkib   = "kibd";
		}else{
		var tabel = "kibe_susut";
		var fkib   = "kibe";
		}
		}
		
		if ( kib == '' ){
            alert('Pilih KIB Terlebih Dahulu...!!!');
            exit();
        }
        
        if ( kib == '01'){
            swal("Oops...", "KIB A Tidak Di susutkan!", "error");
			exit();			
        }
		if ( kib == '06'){
            swal("Oops...", "KIB F Tidak Di susutkan!", "error");
			exit();			
        }
		if ( kib == '07'){
            swal("Oops...", "Aset Lainnya Tidak Di susutkan!", "error");
			exit();			
        }
		
		document.getElementById('load').style.visibility='visible';
		
		$(function(){     
		 $.ajax({
			type: 'POST',
			data: ({kib:kib,skpd:cskpd,tahun:ctahun,hps:hps,tabel:tabel,fkib:fkib}),
			dataType:"json",
			url:"<?php echo base_url(); ?>index.php/laporan_kebijakan/proses_jurnal",
			success:function(data){
				if (data == '1'){
					swal("Good job!", "Proses Jurnal Selesai !!", "success");
				}else{
					swal("Oops...", "Proses Jurnal Gagal!", "error");					
				}
				
				document.getElementById('load').style.visibility='hidden';
			}
		 });
		});
		
	}

    
    function pkibb(){
		/* 
		var cskpd 	= $("#kdubidskpd").combogrid("getValue");
		var mlokasi	= document.getElementById('kdlokasi').value;
        var cnmskpd = document.getElementById('nmskpd').value;
		var ctahun 	= $("#tahun").combobox("getValue"); */
		
    var blnthn  = ctk2;
	var kib 	= $("#kib").combobox("getValue");
    var cskpd   = $('#kdskpd').combogrid('getValue'); 
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
	var mlokasi	= "";//document.getElementById('kdlokasi').value;
    var cbid    = $('#kdubidskpd').combogrid('getValue');
    var cnm_bid = document.getElementById('nmbidskpd').value;
    var pilihan = document.getElementById('pilihancetak').value;
    var bulan   = $('#bulan').combogrid('getValue');
    var tahun   = $('#tahun').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 
	
		var url	  	= "<?php echo site_url(); ?>/laporan_kebijakan/pkibb";
        if(cskpd==''){
            alert('Belum Pilih SKPD.!');
        }else if(kib==''){
            alert('Belum pilih KIB.!')
        }else{
		
        lc = '?kd_skpd='+cskpd+'&ctahun1='+tahun1+'&ctahun2='+tahun2+'&nm_skpd='+cnmskpd+'&unit='+cbid+'&nm_unit='+cnm_bid+'&pilih='+pilihan+'&bulan='+bulan+'&tahun='+tahun+'&tgl2='+lctgl2+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
		//kd_skpd,ctahun,ctahun2,nm_skpd, unit,nm_unit,pilih,bulan,tahun,tgl2,jenis,nmjenis
        window.open(url+lc,'_blank');
        window.focus();
        }
    }
	
	function pkibc(){
				/* 
		var cskpd 	= $("#kdubidskpd").combogrid("getValue");
		var mlokasi	= document.getElementById('kdlokasi').value;
        var cnmskpd = document.getElementById('nmskpd').value;
		var ctahun 	= $("#tahun").combobox("getValue"); */
		
    var blnthn  = ctk2;
	var kib 	= $("#kib").combobox("getValue");
    var cskpd   = $('#kdskpd').combogrid('getValue'); 
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
	var mlokasi	= "";//document.getElementById('kdlokasi').value;
    var cbid    = $('#kdubidskpd').combogrid('getValue');
    var cnm_bid = document.getElementById('nmbidskpd').value;
    var pilihan = document.getElementById('pilihancetak').value;
    var bulan   = $('#bulan').combogrid('getValue');
    var tahun   = $('#tahun').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 
	
		var url	  	= "<?php echo site_url(); ?>/laporan_kebijakan/pkibc";
        if(cskpd==''){
            alert('Belum Pilih SKPD.!');
        }else if(kib==''){
            alert('Belum pilih KIB.!')
        }else{
		
        lc = '?kd_skpd='+cskpd+'&ctahun1='+tahun1+'&ctahun2='+tahun2+'&nm_skpd='+cnmskpd+'&unit='+cbid+'&nm_unit='+cnm_bid+'&pilih='+pilihan+'&bulan='+bulan+'&tahun='+tahun+'&tgl2='+lctgl2+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
		//kd_skpd,ctahun,ctahun2,nm_skpd, unit,nm_unit,pilih,bulan,tahun,tgl2,jenis,nmjenis
        window.open(url+lc,'_blank');
        window.focus();
        }
    }
	
	function pkibd(){
				/* 
		var cskpd 	= $("#kdubidskpd").combogrid("getValue");
		var mlokasi	= document.getElementById('kdlokasi').value;
        var cnmskpd = document.getElementById('nmskpd').value;
		var ctahun 	= $("#tahun").combobox("getValue"); */
		
		
    var blnthn  = ctk2;
	var kib 	= $("#kib").combobox("getValue");
    var cskpd   = $('#kdskpd').combogrid('getValue'); 
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
	var mlokasi	= "";//document.getElementById('kdlokasi').value;
    var cbid    = $('#kdubidskpd').combogrid('getValue');
    var cnm_bid = document.getElementById('nmbidskpd').value;
    var pilihan = document.getElementById('pilihancetak').value;
    var bulan   = $('#bulan').combogrid('getValue');
    var tahun   = $('#tahun').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 
	
		var url	  	= "<?php echo site_url(); ?>/laporan_kebijakan/pkibd";
        if(cskpd==''){
            alert('Belum Pilih SKPD.!');
        }else if(kib==''){
            alert('Belum pilih KIB.!')
        }else{
		
        lc = '?kd_skpd='+cskpd+'&ctahun1='+tahun1+'&ctahun2='+tahun2+'&nm_skpd='+cnmskpd+'&unit='+cbid+'&nm_unit='+cnm_bid+'&pilih='+pilihan+'&bulan='+bulan+'&tahun='+tahun+'&tgl2='+lctgl2+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
		//kd_skpd,ctahun,ctahun2,nm_skpd, unit,nm_unit,pilih,bulan,tahun,tgl2,jenis,nmjenis
        window.open(url+lc,'_blank');
        window.focus();
        }
    }
	
	function pkibe(){
				/* 
		var cskpd 	= $("#kdubidskpd").combogrid("getValue");
		var mlokasi	= document.getElementById('kdlokasi').value;
        var cnmskpd = document.getElementById('nmskpd').value;
		var ctahun 	= $("#tahun").combobox("getValue"); */
		
    var blnthn  = ctk2;
	var kib 	= $("#kib").combobox("getValue");
    var cskpd   = $('#kdskpd').combogrid('getValue'); 
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
	var mlokasi	= "";//document.getElementById('kdlokasi').value;
    var cbid    = $('#kdubidskpd').combogrid('getValue');
    var cnm_bid = document.getElementById('nmbidskpd').value;
    var pilihan = document.getElementById('pilihancetak').value;
    var bulan   = $('#bulan').combogrid('getValue');
    var tahun   = $('#tahun').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 
	
		var url	  	= "<?php echo site_url(); ?>/laporan_kebijakan/pkibe";
        if(cskpd==''){
            alert('Belum Pilih SKPD.!');
        }else if(kib==''){
            alert('Belum pilih KIB.!')
        }else{
		
        lc = '?kd_skpd='+cskpd+'&ctahun1='+tahun1+'&ctahun2='+tahun2+'&nm_skpd='+cnmskpd+'&unit='+cbid+'&nm_unit='+cnm_bid+'&pilih='+pilihan+'&bulan='+bulan+'&tahun='+tahun+'&tgl2='+lctgl2+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
		//kd_skpd,ctahun,ctahun2,nm_skpd, unit,nm_unit,pilih,bulan,tahun,tgl2,jenis,nmjenis
        window.open(url+lc,'_blank');
        window.focus();
        }
    }	
	function pkibg(){
			/* 
		var cskpd 	= $("#kdubidskpd").combogrid("getValue");
		var mlokasi	= document.getElementById('kdlokasi').value;
        var cnmskpd = document.getElementById('nmskpd').value;
		var ctahun 	= $("#tahun").combobox("getValue"); */
			
    var blnthn  = ctk2;
	var kib 	= $("#kib").combobox("getValue");
    var cskpd   = $('#kdskpd').combogrid('getValue'); 
    var tahun1  = $('#tahun1').combogrid('getValue');
    var tahun2  = $('#tahun2').combogrid('getValue');
    var cnmskpd = document.getElementById('nmskpd').value;
	var mlokasi	= "";//document.getElementById('kdlokasi').value;
    var cbid    = $('#kdubidskpd').combogrid('getValue');
    var cnm_bid = document.getElementById('nmbidskpd').value;
    var pilihan = document.getElementById('pilihancetak').value;
    var bulan   = $('#bulan').combogrid('getValue');
    var tahun   = $('#tahun').combogrid('getValue');
    var lctgl2  = $('#tgl_cetak').datebox('getValue');
    var jenis   = $('#jenis').combogrid('getValue');
    var nmjenis = document.getElementById('nmjenis').value; 
	
		var url	  	= "<?php echo site_url(); ?>/laporan_kebijakan/pkibg";
        if(cskpd==''){
            alert('Belum Pilih SKPD.!');
        }else if(kib==''){
            alert('Belum pilih KIB.!')
        }else{
		
        lc = '?kd_skpd='+cskpd+'&ctahun1='+tahun1+'&ctahun2='+tahun2+'&nm_skpd='+cnmskpd+'&unit='+cbid+'&nm_unit='+cnm_bid+'&pilih='+pilihan+'&bulan='+bulan+'&tahun='+tahun+'&tgl2='+lctgl2+'&jenis='+jenis+'&nmjenis='+nmjenis+'&blnthn='+blnthn;
		//kd_skpd,ctahun,ctahun2,nm_skpd, unit,nm_unit,pilih,bulan,tahun,tgl2,jenis,nmjenis
        window.open(url+lc,'_blank');
        window.focus();
        }
    }
    
    $(function(){
      $('#kdskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_skpd_dh',  
           columns:[[  
               {field:'kd_skpd',title:'KODE SKPD',width:100},  
               {field:'nm_skpd',title:'NAMA SKPD',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_skpd;
               lcunit = rowData.kd_lokasi;
               $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpdh',queryParams:({skpd:lcskpd}) });
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
			   $("#funit").attr("value",lcunit);
               $('#kdubidskpd').combogrid('clear');
               $('#jenis').combogrid('clear');
               $('#bulan').combogrid('clear');
               $('#tahun').combogrid('clear');
               $('#tahun1').combogrid('clear');
               $('#tahun2').combogrid('clear');
               $('#tahu').combogrid('clear');
               $('#bend').combogrid('clear');
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa',queryParams:({kduskpd:lcskpd,kode:'1'}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb',queryParams:({kduskpd:lcskpd,kode:'1'}) });
               $('#jenis').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_keg_kel',queryParams:({kdskpd:lcskpd,unit:''}) });
                                
           }  
         });
		 
        $('#kdubidskpd').combogrid({  
           panelWidth:500,  
           idField:'kd_uskpd',  
           textField:'kd_uskpd',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_ubidskpd',  
           columns:[[  
               {field:'kd_uskpd',title:'KODE UNIT BIDANG',width:150},  
               {field:'nm_uskpd',title:'NAMA UNIT BIDANG',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               lcskpd = rowData.kd_uskpd;
               var cskpd   = $('#kdskpd').combogrid('getValue');
              // $('#kdubidskpd').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_uskpd',queryParams:({kduskpd:lcskpd}) });
               $("#nmbidskpd").attr("value",rowData.nm_uskpd.toUpperCase());
               $('#tahu').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pa2',queryParams:({kduskpd:lcskpd}) });
               $('#bend').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_pb2',queryParams:({kduskpd:lcskpd}) });
               $('#jenis').combogrid({url:'<?php echo base_url(); ?>index.php/master/ambil_keg_kel',queryParams:({kdskpd:cskpd,unit:lcskpd}) });
                             
           }  
         });

       /* $('#tahun').combobox({           
        valueField:'nama',  
        textField:'nama',
        width:50,
        data:[{kode:'0',nama:'2012'},{kode:'1',nama:'2013'},{kode:'2',nama:'2014'},{kode:'3',nama:'2015'},{kode:'4',nama:'2016'},
        {kode:'5',nama:'2017'}]
    }); */
	
	
	
      $('#jenis').combogrid({  
           panelWidth:550,  
           idField:'giat',  
           textField:'namagiat',  
           mode:'remote',
           //url:'<?php echo base_url(); ?>index.php/master/ambil_jenis',
           //queryParams:({kode:'03'}), 
           columns:[[  
               {field:'giat',title:'KODE KEGIATAN',width:150},  
               {field:'namagiat',title:'NAMA KEGIATAN',width:400}    
           ]],  
           onSelect:function(rowIndex,rowData){
               jenis = rowData.namagiat;
               $("#nmjenis").attr("value",rowData.namagiat.toUpperCase()); 
           }  
         });				 
				 
        
         $('#tgl_cetak').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
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
	
		 
				 $('#tgl_cetak').datebox('setValue','<?php echo date('Y-m-d')?>');
				$('#tgl_reg').datebox('setValue','<?php echo date('Y-m-d')?>');
	
    }); 
	
	function bulan(){
  $('#bulan').combogrid({  
           panelWidth:300,  
           idField:'n_bulan',  
           textField:'bulan',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/ambil_bulan',  
           columns:[[  
               {field:'n_bulan',title:'No',width:50},  
               {field:'bulan',title:'NAMA BULAN',width:250}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}
function tahun(){
  $('#tahun').combogrid({  
           panelWidth:100,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun',  
           columns:[[  
               {field:'tahun',title:'TAHUN',width:50}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}

function tahun1(){
  $('#tahun1').combogrid({  
           panelWidth:100,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun',  
           columns:[[  
               {field:'tahun',title:'TAHUN',width:50}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}

function tahun2(){
  $('#tahun2').combogrid({  
           panelWidth:100,  
           idField:'tahun',  
           textField:'tahun',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/master/tahun',  
           columns:[[  
               {field:'tahun',title:'TAHUN',width:50}    
           ]],  
           onSelect:function(rowIndex,rowData){
                                            
           }  
      });
}

	
	function opt2(val){
  ctk2=val;
  if(ctk2=='01'){
      $("#div_bulan").show();
      $("#div_tahun").show();
      $("#div_tahunsd").hide();
      $('#tahun1').combogrid('clear');
      $('#tahun2').combogrid('clear');
  }else{
      $("#div_bulan").hide();
      $('#bulan').combogrid('clear');
      $("#div_tahun").hide();
      $('#tahun').combogrid('clear');
      $("#div_tahunsd").show();
  }

}
	
   </script>

<style>
.myButton {
	-moz-box-shadow: 0px 10px 24px -8px #276873;
	-webkit-box-shadow: 0px 10px 24px -8px #276873;
	box-shadow: 0px 10px 24px -8px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #599bb3), color-stop(1, #408c99));
	background:-moz-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-webkit-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-o-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:-ms-linear-gradient(top, #599bb3 5%, #408c99 100%);
	background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#599bb3', endColorstr='#408c99',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:22px;
	font-weight:bold;
	padding:12px 58px;
	text-decoration:none;
	text-shadow:-1px 5px 0px #3d768a;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #599bb3));
	background:-moz-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-webkit-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-o-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:-ms-linear-gradient(top, #408c99 5%, #599bb3 100%);
	background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#408c99', endColorstr='#599bb3',GradientType=0);
	background-color:#408c99;
}
.myButton:active {
	position:relative;
	top:1px;
}


.kibb {
	-moz-box-shadow: 0px 10px 24px -8px #276873;
	-webkit-box-shadow: 0px 10px 24px -8px #276873;
	box-shadow: 0px 10px 24px -8px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #8A2BE2), color-stop(1, #8A2BE2));
	background:-moz-linear-gradient(top, #8A2BE2 5%, #8A2BE2 100%);
	background:-webkit-linear-gradient(top, #8A2BE2 5%, #8A2BE2 100%);
	background:-o-linear-gradient(top, #8A2BE2 5%, #8A2BE2 100%);
	background:-ms-linear-gradient(top, #8A2BE2 5%, #8A2BE2 100%);
	background:linear-gradient(to bottom, #8A2BE2 5%, #8A2BE2 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8A2BE2', endColorstr='#8A2BE2',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:12px;
	font-weight:bold;
	padding:8px 5px;
	text-decoration:none;
}
.kibb:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #000000));
	background:-moz-linear-gradient(top, #000000 5%, #000000 100%);
	background:-webkit-linear-gradient(top, #000000 5%, #000000 100%);
	background:-o-linear-gradient(top, #000000 5%, #000000 100%);
	background:-ms-linear-gradient(top, #000000 5%, #000000 100%);
	background:linear-gradient(to bottom, #000000 5%, #000000 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000',GradientType=0);
	background-color:#000000;
}
.kibb:active {
	position:relative;
	top:1px;
}


.kibc {
	-moz-box-shadow: 0px 10px 24px -8px #276873;
	-webkit-box-shadow: 0px 10px 24px -8px #276873;
	box-shadow: 0px 10px 24px -8px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #A52A2A), color-stop(1, #A52A2A));
	background:-moz-linear-gradient(top, #A52A2A 5%, #A52A2A 100%);
	background:-webkit-linear-gradient(top, #A52A2A 5%, #A52A2A 100%);
	background:-o-linear-gradient(top, #A52A2A 5%, #A52A2A 100%);
	background:-ms-linear-gradient(top, #A52A2A 5%, #A52A2A 100%);
	background:linear-gradient(to bottom, #A52A2A 5%, #A52A2A 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#A52A2A', endColorstr='#A52A2A',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:12px;
	font-weight:bold;
	padding:8px 5px;
	text-decoration:none;
}
.kibc:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #000000));
	background:-moz-linear-gradient(top, #000000 5%, #000000 100%);
	background:-webkit-linear-gradient(top, #000000 5%, #000000 100%);
	background:-o-linear-gradient(top, #000000 5%, #000000 100%);
	background:-ms-linear-gradient(top, #000000 5%, #000000 100%);
	background:linear-gradient(to bottom, #000000 5%, #000000 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000',GradientType=0);
	background-color:#000000;
}
.kibc:active {
	position:relative;
	top:1px;
}


.kibd {
	-moz-box-shadow: 0px 10px 24px -8px #276873;
	-webkit-box-shadow: 0px 10px 24px -8px #276873;
	box-shadow: 0px 10px 24px -8px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #FF8C00), color-stop(1, #FF8C00));
	background:-moz-linear-gradient(top, #FF8C00 5%, #FF8C00 100%);
	background:-webkit-linear-gradient(top, #FF8C00 5%, #FF8C00 100%);
	background:-o-linear-gradient(top, #FF8C00 5%, #FF8C00 100%);
	background:-ms-linear-gradient(top, #FF8C00 5%, #FF8C00 100%);
	background:linear-gradient(to bottom, #FF8C00 5%, #FF8C00 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FF8C00', endColorstr='#FF8C00',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:12px;
	font-weight:bold;
	padding:8px 5px;
	text-decoration:none;
}
.kibd:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #000000));
	background:-moz-linear-gradient(top, #000000 5%, #000000 100%);
	background:-webkit-linear-gradient(top, #000000 5%, #000000 100%);
	background:-o-linear-gradient(top, #000000 5%, #000000 100%);
	background:-ms-linear-gradient(top, #000000 5%, #000000 100%);
	background:linear-gradient(to bottom, #000000 5%, #000000 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000',GradientType=0);
	background-color:#000000;
}
.kibd:active {
	position:relative;
	top:1px;
}


.kibe {
	-moz-box-shadow: 0px 10px 24px -8px #276873;
	-webkit-box-shadow: 0px 10px 24px -8px #276873;
	box-shadow: 0px 10px 24px -8px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #32CD32), color-stop(1, #32CD32));
	background:-moz-linear-gradient(top, #32CD32 5%, #32CD32 100%);
	background:-webkit-linear-gradient(top, #32CD32 5%, #32CD32 100%);
	background:-o-linear-gradient(top, #32CD32 5%, #32CD32 100%);
	background:-ms-linear-gradient(top, #32CD32 5%, #32CD32 100%);
	background:linear-gradient(to bottom, #32CD32 5%, #32CD32 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#32CD32', endColorstr='#32CD32',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:12px;
	font-weight:bold;
	padding:8px 5px;
	text-decoration:none;
}
.kibe:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #000000));
	background:-moz-linear-gradient(top, #000000 5%, #000000 100%);
	background:-webkit-linear-gradient(top, #000000 5%, #000000 100%);
	background:-o-linear-gradient(top, #000000 5%, #000000 100%);
	background:-ms-linear-gradient(top, #000000 5%, #000000 100%);
	background:linear-gradient(to bottom, #000000 5%, #000000 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000',GradientType=0);
	background-color:#000000;
}
.kibe:active {
	position:relative;
	top:1px;
}

.kibg {
	-moz-box-shadow: 0px 10px 24px -8px #276873;
	-webkit-box-shadow: 0px 10px 24px -8px #276873;
	box-shadow: 0px 10px 24px -8px #276873;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0130fc), color-stop(1, #0130fc));
	background:-moz-linear-gradient(top, #0130fc 5%, #0130fc 100%);
	background:-webkit-linear-gradient(top, #0130fc 5%, #0130fc 100%);
	background:-o-linear-gradient(top, #0130fc 5%, #0130fc 100%);
	background:-ms-linear-gradient(top, #0130fc 5%, #0130fc 100%);
	background:linear-gradient(to bottom, #0130fc 5%, #0130fc 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0130fc', endColorstr='#0130fc',GradientType=0);
	background-color:#599bb3;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
	border-radius:2px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Verdana;
	font-size:12px;
	font-weight:bold;
	padding:8px 5px;
	text-decoration:none;
}
.kibg:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #000000));
	background:-moz-linear-gradient(top, #000000 5%, #000000 100%);
	background:-webkit-linear-gradient(top, #000000 5%, #000000 100%);
	background:-o-linear-gradient(top, #000000 5%, #000000 100%);
	background:-ms-linear-gradient(top, #000000 5%, #000000 100%);
	background:linear-gradient(to bottom, #000000 5%, #000000 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#000000', endColorstr='#000000',GradientType=0);
	background-color:#000000;
}
.kibg:active {
	position:relative;
	top:1px;
}
   </style>

<div id="content1"> 
    <h3 align="center"><b>PROSES PENYUSUTAN</b></h3>
    <fieldset>
     <table align="center" style="width:100%;" border="0">
	          <tr>
                <td colspan="2" style="width: 200px;"><input type="radio" name="cetak" value="1" onclick="opt1(this.value)" />SKPD &ensp;</td>
				<td style="width: 50px;"><input type="radio" name="cetak" value="2" id="status" onclick="opt1(this.value)" />UNIT&ensp;</td>
            </tr>
            

            <tr>
                <td colspan="3">
                <div id="skpd">
                        <table style="width:100%;" border="0">
                            <td width="20%">SKPD</td>
                            <td width="1%">:</td>
                            <td><input id="kdskpd" name="kdskpd" style="width: 100px;" />
							<input hidden="true" id="funit" name="funit" style="width: 100px;" />
                            <input type="hidden" id="nip_tahu"/> 
							 <input  readonly="true" type="text" id="nmskpd" style="width: 500px;border:0"/> 
                            </td> 
                        </table>
                </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                <div id="div_skpd">
                        <table style="width:100%;" border="0">
                            <td width="20%">UNIT</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="kdubidskpd" name="kdubidskpd" style="width: 100px;" />
                            <input type="text" id="nmbidskpd" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
                </td>
            </tr>


            <tr>
                <td colspan="3">
                <div id="pilihancetak">
                        <table style="width:100%;" border="0">
                            <td width="20%">Pilih Penyusutan</td>
                            <td width="1%">:</td>
                            <td><input type="radio" name="cetak2" value="01" onclick="opt2(this.value)" />Penyusutan Per Bulan &ensp;</td>
                            <td><input type="radio" name="cetak2" value="02" id="status" onclick="opt2(this.value)" />Penyusutan Per Tahun&ensp;</td>
                        </table>
                </div>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                <div id="div_jenis">
                        <table style="width:100%;" border="0">
                            <td width="20%">PILIH KEGIATAN</td>
                            <td width="1%">:</td>
                            <td width="79%"><input id="jenis" name="jenis" style="width: 300px;" />
                            <input type="hidden" id="nmjenis" readonly="true" style="width: 500px;border:0" />
                            </td>
                        </table>
                </div>
                </td>
            </tr>
			
            <tr>
              <td colspan="3">
                <div id="div_bulan">
                  <table style="width:100%;" border="0">
                    <td width="20%" >BULAN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="bulan" id="bulan" style="width: 150px;" >
                    </td>
                  </table>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="3">
                <div id="div_tahun">
                  <table style="width:100%;" border="0">
                    <td width="20%" >TAHUN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="tahun" id="tahun" style="width: 150px;" >
                    </td>
                  </table>
                </div>
              </td>
            </tr>
             <tr>
              <td colspan="3">
                <div id="div_tahunsd">
                  <table style="width:100%;" border="0">
                    <td width="20%" >TAHUN</td>
                    <td width="1%" >:</td>
                    <td width="79%" ><input  name="tahun1" id="tahun1" style="width: 150px;" > s/d <input  name="tahun2" id="tahun2" style="width: 150px;" >
                    </td>
                  </table>
                </div>
              </td>
            </tr>
			<tr>
                <td width="20%">TANGGAL CETAK</td>
                <td width="1%">:</td>
                <td width="900px"><input type="text" id="tgl_cetak" style="width: 140px;" /></td>  
            </tr>
			<tr>
                <td width="20%">KIB</td>
                <td width="1%">:</td>
                <td width="900px"><input id="kib" name="kib" style="width: 150px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="nmkib" readonly="true" name="nmkib" style="width: 500px; border:0;" /></td>  
            </tr>
			<tr>
                <td width="20%">HAPUS PROSES SEBELUMNYA</td>
                <td width="1%">:</td>
                <td width="10px"><input type="checkbox" value="1" style="width: 10px;"  onclick="opt(this.value)" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input id="hps" name="hps" hidden="true" style="width: 10px; border:0;" /><i><font color="red">*pilih jika ingin menghapus preses sebelumnya.</font></i></td>  
            </tr>		
            <tr>
			<div id="content"> 
					<div id="accordion">
						<p align="right" >         
							<table id="" title="Proses Penyusutan/Jurnal" style="width:800px;height:100px;" border="0px"> 
							<tr>
								<td width="20%" align="center"> <a onclick="javascript:pkibb();" class="kibb">PREVIEW KIB B</a></td>
								<td width="20%" align="center"> <a onclick="javascript:pkibc();" class="kibc">PREVIEW KIB C</a></td>
								<td width="20%" align="center"> <a onclick="javascript:pkibd();" class="kibd">PREVIEW KIB D</a></td>
								<td width="20%" align="center"> <a onclick="javascript:pkibe();" class="kibe">PREVIEW KIB E</a></td>
								<td width="20%" align="center"> <a onclick="javascript:pkibg();" class="kibg">PREVIEW LAINNYA</a></td>
							</tr>
							</table>               
							<table id="" title="Proses Penyusutan" style="width:920px;height:50px;" border="0px"> 
							<tr>
								<td width="100%" align="center"> <a onclick="javascript:proses_susut();" class="myButton">PROSES PENYUSUTAN</a></td>
								<!--td width="50%" align="center"> <a onclick="javascript:proses_jurnal();" class="myButton">PROSES JURNAL</a></td-->
							</tr>
							<tr height="100%" >
								<td colspan="3" align="center" style="visibility:hidden;height:50px" ></td>
							</tr>
							<tr height="50%" >
								<td colspan="3" align="center" style="visibility:hidden" >	
								<DIV id="load"> <IMG src="<?php echo base_url(); ?>public/images/upload.gif" WIDTH="250" HEIGHT="120" BORDER="0" ALT=""></DIV></td>
							</tr>
							</table>             
						</p> 
					</div>
			</div>              
            </tr>
        </table>  
            
    </fieldset>  
</div>




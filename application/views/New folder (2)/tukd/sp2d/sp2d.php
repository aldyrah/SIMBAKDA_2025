	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css"/>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">

    
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
	  <link href='<?php echo base_url();?>assets/js/jquery.autocomplete.css' rel='stylesheet' />
	<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.autocomplete.js'></script>
   
    <script type="text/javascript"> 
    
    var nl =0;
	var tnl =0;
	var idx=0;
	var tidx=0;
	var oldRek=0;
    var rek=0;
    
    $(function(){
   	     $('#dd').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
   	});


 $(function(){
   	     $('#icad').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
   	});

        $(function(){
            $('#csp2d').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_sp2d',  
                    idField:'no_sp2d',                    
                    textField:'no_sp2d',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_sp2d',title:'SP2D',width:60},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:60},
                        {field:'no_spm',title:'SPM',width:60} 
                          
                    ]],
                    onSelect:function(rowIndex,rowData){
                    kode = rowData.no_sp2d;
                    dns = rowData.kd_skpd;
                    val_ttd(dns);
                    }   
                });
           });
           
        function val_ttd(dns){
           $(function(){
            $('#ttd').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_ttd2/'+dns,  
                    idField:'nip',                    
                    textField:'nama',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'nip',title:'NIP',width:60},  
                        {field:'nama',title:'NAMA',align:'left',width:100}
                        
                        
                    ]],
                    onSelect:function(rowIndex,rowData){
                    nip = rowData.nip;
                    
                    }   
                });
           });              
         }
    $(function(){ 
     $('#sp2d').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_sp2d',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'no_sp2d',
    		title:'Nomor SP2D',
    		width:40},
            {field:'no_spm',
    		title:'Nomor SPM',
    		width:40},
            {field:'tgl_sp2d',
    		title:'Tanggal',
    		width:30},
            {field:'kd_skpd',
    		title:' SKPD',
    		width:30,
            align:"left"},
            {field:'keperluan',
    		title:'Keterangan',
    		width:140,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          no_sp2d = rowData.no_sp2d;
          no_spm = rowData.no_spm;
          tgs  = rowData.tgl_sp2d;
          st = rowData.status;
		  
		
		tgspm = rowData.tgl_spm
		no_spp = rowData.no_spp;         
		dn  = rowData.kd_skpd;
		sp  = rowData.no_spd;          
		bl  = rowData.bulan;
		tg  = rowData.tgl_spp;
		jn  = rowData.jns_spp;
		kep  = rowData.keperluan;
		np  = rowData.npwp;
		rekan  = rowData.nmrekan;
		bk  = rowData.bank;
		ning  = rowData.no_rek;
		nm  = rowData.nm_skpd;

		  getspm(no_sp2d,no_spm,tgs,st,tgspm,no_spp,dn,sp,tg,bl,jn,kep,np,rekan,bk,ning,nm);                                                      
		  detail();
		  pot();
        },
        onDblClickRow:function(rowIndex,rowData){
            section2();
            $("#no_sp2d").attr("disabled",true);
            $("#nospm").combogrid("disable");
            $("#dd").datebox("disable");
					
        }
    });
    }); 
        
              
   $(function(){
            $('#nospm').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/nospmsp2d',  
                    idField:'no_spm',                    
                    textField:'no_spm',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_spm',title:'No',width:60},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:80} 
                          
                    ]],
                     onSelect:function(rowIndex,rowData){
                        no_spm = rowData.no_spm
                        tgspm = rowData.tgl_spm
                        no_spp = rowData.no_spp;         
                        dn  = rowData.kd_skpd;
                        sp  = rowData.no_spd;          
                        bl  = rowData.bulan;
                        tg  = rowData.tgl_spp;
                        jn  = rowData.jns_spp;
                        kep  = rowData.keperluan;
                        np  = rowData.npwp;
                        rekan  = rowData.nmrekan;
                        bk  = rowData.bank;
                        ning  = rowData.no_rek;
                        nm  = rowData.nm_skpd;        
                        get(no_spm,tgspm,no_spp,dn,sp,tg,bl,jn,kep,np,rekan,bk,ning,nm);
                       detail();
                       pot();                                                              
                    }  
                });
           });
 
             
        $(function(){
			$('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                 autoRowHeight:"true",
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 singleSelect:"true"
                                  
			});
		}); 
        
        
        
        $(function(){
			$('#pot').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/pot',
                 autoRowHeight:"true",
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 singleSelect:"true",
                                  
			});
		}); 
    
  
        
        function detail(){
        $(function(){            
			$('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams:({spp:no_spp}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,
                 onLoadSuccess:function(data){                      
                      load_sum_spm();
                      },                                  			 				 
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},                     
                     {field:'kdkegiatan',
					 title:'Kegiatan',
					 width:150,
					 align:'left'
					},
					{field:'kdrek5',
					 title:'Rekening',
					 width:70,
					 align:'left'
					},
					{field:'nmrek5',
					 title:'Nama Rekening',
					 width:400					 
					},
                    {field:'nilai1',
					 title:'Nilai',
					 width:130,
                     align:'right'
                     }
                      
				]]	
			
			});
  	

		});
        }
        
        function detail1(){
        $(function(){ 
            var no_spp='';
			$('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams:({spp:no_spp}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,                                                   			 				 
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},                     
                     {field:'kdkegiatan',
					 title:'Kegiatan',
					 width:150,
					 align:'left'
					},
					{field:'kdrek5',
					 title:'Rekening',
					 width:70,
					 align:'left'
					},
					{field:'nmrek5',
					 title:'Nama Rekening',
					 width:300					 
					},
                    {field:'sisa',
					 title:'Sisa',
					 width:100,
                     align:'right'				 
                     },
                    {field:'nilai1',
					 title:'Nilai',
					 width:100,
                     align:'right'
                     }
                      
				]]	
			
			});
  	

		});
        }
        
        
        
         function pot(){
        $(function(){
	   	    //alert(no_spm);                         
			$('#pot').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/pot',
                queryParams:({spm:no_spm}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,
                 onLoadSuccess:function(data){                      
                      load_sum_pot();
                      },                              			 				 
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},                    
					{field:'kd_rek5',
					 title:'Rekening',
					 width:100,
					 align:'left'
					},
					{field:'nm_rek5',
					 title:'Nama Rekening',
					 width:500
					},                    
                    {field:'nilai',
					 title:'Nilai',
					 width:100,
                     align:'right'
                     },
                     {field:'pot',
					 title:'ket',
					 width:30,
                     align:'center'
                     }
                      
				]]	
			
			});
  	

		});
        }
        
        function pot1(){
        $(function(){
	   	    var no_spm='';                         
			$('#pot').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/pot',
                queryParams:({spm:no_spm}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,                                              			 				 
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},                    
					{field:'kd_rek5',
					 title:'Rekening',
					 width:100,
					 align:'left'
					},
					{field:'nm_rek5',
					 title:'Nama Rekening',
					 width:500
					},                    
                    {field:'nilai',
					 title:'Nilai',
					 width:100,
                     align:'right'
                     },
                     {field:'pot',
					 title:'ket',
					 width:30,
                     align:'center'
                     }
                      
				]]	
			
			});
  	

		});
        }
              
        function get(no_spm,tgspm,no_spp,kd_skpd,no_spd,tgl_spp,bulan,jns_spp,keperluan,npwp,rekanan,bank,rekening,nm_skpd){
        $("#no_spm").attr("value",no_spm);
        $("#tgl_spm").attr("value",tgspm);
        $("#nospp").attr("value",no_spp);
        $("#dn").attr("value",kd_skpd);
        $("#sp").attr("value",no_spd);        
        $("#tgl_spp").attr("value",tgl_spp);
        $("#kebutuhan_bulan").attr("Value",bulan);
        $("#ketentuan").attr("Value",keperluan);
        $("#jns_beban").attr("Value",jns_spp);
        $("#npwp").attr("Value",npwp);
        $("#rekanan").attr("Value",rekanan);
        $("#bank1").attr("Value",bank);
        $("#rekening").attr("Value",rekening);
        $("#nmskpd").attr("Value",nm_skpd);
                    
        }
                  
        function getspm(no_sp2d,no_spm,tgl_sp2d,status,tgspm,no_spp,kd_skpd,no_spd,tgl_spp,bulan,jns_spp,keperluan,npwp,rekanan,bank,rekening,nm_skpd){
        $("#no_sp2d").attr("value",no_sp2d);
		$("#no_sp2dx").attr("value",no_sp2d);
        $("#nospm").combogrid("setValue",no_spm);
        $("#dd").datebox("setValue",tgl_sp2d);
		$("#tgl_spm").attr("value",tgspm);
        $("#nospp").attr("value",no_spp);
        $("#dn").attr("value",kd_skpd);
        $("#sp").attr("value",no_spd);        
        $("#tgl_spp").attr("value",tgl_spp);
        $("#kebutuhan_bulan").attr("Value",bulan);
        $("#ketentuan").attr("Value",keperluan);
        $("#jns_beban").attr("Value",jns_spp);
        $("#npwp").attr("Value",npwp);
        $("#rekanan").attr("Value",rekanan);
        $("#bank1").attr("Value",bank);
        $("#rekening").attr("Value",rekening);
        $("#nmskpd").attr("Value",nm_skpd);
      
        tombol(status);                   
        }
		
        function kosong(){
        cdate = '<?php echo date("Y-m-d"); ?>';
        $("#nospm").combogrid("enable");
        $("#no_sp2d").attr("disabled",false);
        $("#no_sp2d").attr("value",'');
        
		$("#no_sp2dx").attr("value",'');
        $("#dd").datebox("setValue",cdate);
        $("#dd").datebox("enable");
        $("#nospm").combogrid("clear");
        $("#nospp").attr("value",'');
        $("#dn").attr("value",'');
        $("#sp").attr("value",'');        
        $("#tgl_spp").attr("value",'');
        $("#tgl_spm").attr("value",'');
        $("#kebutuhan_bulan").attr("Value",'');
        $("#ketentuan").attr("Value",'');
        $("#jns_beban").attr("Value",'');
        $("#npwp").attr("Value",'');
        $("#rekanan").attr("Value",'');
        $("#bank1").attr("Value",'');
        $("#rekening").attr("Value",'');
        $("#nmskpd").attr("Value",''); 
        $("#rekspm").attr("value",'');
        $("#rekspm1").attr("value",''); 
        $("#rektotal").attr("value",''); 
        document.getElementById("p1").innerHTML="";
        detail1();
        pot1();	
		$("#nospm").combogrid("clear");
        tombolnew();  
		reaload_spm();
			
        }


        $(document).ready(function() {
            $("#accordion").accordion();
            $("#lockscreen").hide();                        
            $("#frm").hide();
            $("#dialog-modal").dialog({
            height: 200,
            width: 700,
            modal: true,
            autoOpen:false
        });
        });
       
    function cetak(){
		$('#csp2d').combogrid('grid').edatagrid('reload');
        var nom=document.getElementById("no_sp2d").value;
        $("#csp2d").combogrid("setValue",nom);
        $("#dialog-modal").dialog('open');
    } 
    
    function keluar(){
        $("#dialog-modal").dialog('close');
    }   
     function cari(){
	 var icad = $('#icad').datebox('getValue'); 
     var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
            $('#sp2d').edatagrid({
	       url: '<?php echo base_url(); ?>/index.php/tukd/load_sp2d',
         queryParams:({cari:kriteria,icad:icad})
        });        
     });
    }
        
       function simpan_sp2d(){        
        var a1 = document.getElementById('no_sp2d').value;
        var b1 = $('#dd').datebox('getValue');        
        var b2 =document.getElementById('tgl_spm').value;
        var b = document.getElementById('tgl_spp').value;      
        var c = document.getElementById('jns_beban').value; 
        var d = document.getElementById('kebutuhan_bulan').value;
        var e = document.getElementById('ketentuan').value;
        var f = document.getElementById('rekanan').value;
        var g = document.getElementById('bank1').value;
        var h = document.getElementById('npwp').value;
        var i = document.getElementById('rekening').value;
        var j = document.getElementById('nmskpd').value;
        var k = document.getElementById('dn').value;
        var l = document.getElementById('sp').value;
        var m = document.getElementById('rekspm1').value;
		var ek= document.getElementById('no_sp2dx').value;
        //alert(a1+b1+no_spm+b2+no_spp+b);
                
        $(function(){      
         $.ajax({
            type: 'POST',
            data: ({cskpd:k,cspd:l,no_sp2d:a1,tgl_sp2d:b1,no_spm:no_spm,tgl_spm:b2,no_spp:no_spp,tgl_spp:b,jns_spp:c,bulan:d,keperluan:e,nmskpd:j,rekanan:f,bank:g,npwp:h,rekening:i,nilai:m,cek:ek}),
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/tukd/simpan_sp2d",
            success:function(data){
                if (data=='1'){
                   // alert('Data Berhasil Tersimpan');
				   
				   
swal({
			  title: 'Data Tersimpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
                    $('#sp2d').edatagrid('reload');
                    section1();
                }else if ( data=='2'){
					 alert('Nomor SP2D Sudah Terpakai...!!!,  Ganti Nomor SP2D...!!!');
				}else{
                    alert('Data Gagal Tersimpan');

                }
            }
         });
        });
        }
    
  
                  
         function hhapus(){				
            var sp2d = document.getElementById("no_sp2d").value;
            //var spp = document.getElementById("no_spp").value; 
            alert(sp2d+no_spm);             
            var urll= '<?php echo base_url(); ?>/index.php/tukd/hapus_sp2d';             			    
         	if (sp2d !=''){
				var del=confirm('Anda yakin akan menghapus SP2D '+sp2d+'  ?');
				if  (del==true){
					$(document).ready(function(){
                    $.post(urll,({no:sp2d,spm:no_spm}),function(data){
                    status = data;
                        $('#sp2d').edatagrid('reload');
                    });
                    });
				
				}
				} 
		}
        
        
        
        function load_sum_spm(){           
        $(function(){      
         $.ajax({
            type: 'POST',
            data:({spp:no_spp}),
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_spm",
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#rekspm").attr("value",n['rekspm']);
                    $("#rekspm1").attr("value",n['rekspm1']);
                });
            }
         });
        });
    }         
        
        function load_sum_pot(){                
		//var spm = document.getElementById('no_spm').value;              
        $(function(){      
         $.ajax({
            type: 'POST',
            data:({spm:no_spm}),
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_pot",
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#rektotal").attr("value",n['rektotal']);
                });
            }
         });
        });
    }

     function section1(){
         $(document).ready(function(){    
             $('#section1').click();
             $('#sp2d').edatagrid('reload');                                               
         });
     }
     function section2(){
         $(document).ready(function(){    
             $('#section2').click();                                               
         });
     }
     function section3(){
         $(document).ready(function(){    
             $('#section3').click();                                               
         });
     }
     
     function tombol(st){  
     if (st=='1'){
     $('#save').linkbutton('disable');
     $('#del').linkbutton('disable');
     $('#poto').linkbutton('disable');       
     document.getElementById("p1").innerHTML="Sudah di CAIRKAN!!";
     } else {
     $('#save').linkbutton('enable');
     $('#del').linkbutton('enable');
     $('#poto').linkbutton('enable');     
     document.getElementById("p1").innerHTML="";
     }
    }
    
    function tombolnew(){  
    
     $('#save').linkbutton('enable');
     $('#del').linkbutton('enable');   
    }
    
    function openWindow( url )
        {
      
        var no =kode.split("/").join("123456789");
       // alert(no);
        window.open(url+'/'+no+'/'+dns, '_blank');
        window.focus();
        }

    /* function cekdulu()
       {
          var sd=$('#dd').datebox('getValue');
          var lcno = document.getElementById('no_sp2d').value;
           var fd = document.getElementById("tgl_spm").value; 
          var a= sd.length;
             
          var bulanspp = fd.substr(5,2);
          var tglspp = fd.substr(8,10);
          var tahunspp = fd.substr(0,4);
          
            if(lcno ==''){
               
                alert('Nomor SP2D Tidak Boleh kosong')
                document.getElementById('no_sp2d').focus();
                exit();
            }

          // if(cstatus==true){
           if(b='-'){
            var bulanspm= sd.substr(5,1);
           }
           
           
          if (a==8){
            var tglspm = sd.substr(7,8);
            var bulanspm= sd.substr(5,1);
            var tahunspm = sd.substr(0,4);
          }else if(a==9){
            var tglspm =sd.substr(7,9);
            var tahunspm = sd.substr(0,4);
            var b= sd.substr(6,1);
          if(b=='-'){
            var bulanspm= sd.substr(5,1);
           }else{
              var bulanspm= sd.substr(5,2);
           }
          }else if(a==10){
            var tglspm = sd.substr(8,10);
            var bulanspm= sd.substr(5,2);
            var tahunspm = sd.substr(0,4);
           }
           
           if(tglspm<0){
             tglspm=tglspm*-1;
           }
           
           
          var tglsel=tglspm-tglspp;
          var blsel=bulanspm-bulanspp;
          var thnsel=tahunspm-tahunspp;


          if(tglsel<0 || blsel<0 ||thnsel<0 )
          {
             alert("tidak boleh kurang tgl : "+tglsel+" bulan : "+blsel+" tahun :"+thnsel);
           exit();
          }else{
          simpan_sp2d();
          }
       //}else{
          //cek();
       //}
    }*/

    function cekdulu()
 {
	 
	 
        var sd=$('#dd').datebox('getValue');
        var lcno = document.getElementById('no_sp2d').value;
        var fd = document.getElementById("tgl_spm").value;
        var a= sd.length;
        var bulanspp = fd.substr(5,2);
        var tglspp = fd.substr(8,10);
        var tahunspp = fd.substr(0,4);


//alert("aa");
         if(sd=='' || sd=='0000-00-00'){
            alert("Tanggal SP2D Tidak Boleh Kosong!!!");
            exit();
         }
          if(lcno ==''){
               
                alert('Nomor SP2D Tidak Boleh kosong')
                document.getElementById('no_sp2d').focus();
                exit();
            }
         
        if (a==8){
            var tglspm = sd.substr(7,8);
            var bulanspm= sd.substr(5,1);
            var tahunspm = sd.substr(0,4);
        }else if(a==9){
            var tglspm =sd.substr(7,9);
            var tahunspm = sd.substr(0,4);
            var b= sd.substr(6,1);
        if(b=='-'){
            var bulanspm= sd.substr(5,1);
         }else{
            var bulanspm= sd.substr(5,2);
         }
        }else if(a==10){
            var tglspm = sd.substr(8,10);
            var bulanspm= sd.substr(5,2);
            var tahunspm = sd.substr(0,4);
         }
         
         if(tglspm<0){
             tglspm=tglspm*-1;
         }
         
         
        var tglsel=tglspm-tglspp;
        var blsel=bulanspm-bulanspp;
        var thnsel=tahunspm-tahunspp;

		
		
		
        if(thnsel<0)
        {
           alert("Tidak Boleh Kurang Tahun :"+thnsel);
         exit();
        }else if(thnsel==0){
			
			 if(blsel<0)
				{
					alert("Tidak Boleh Kurang bulan : "+blsel);
					exit();
				}else if(blsel==0){
						if(tglsel<0){
							alert("Tidak Boleh Kurang Tgl : "+tglsel);
							}else{
							//	 alert("bb");
							controlsp2d();
							}
				}else if(blsel>0){
						//alert("cc");
						controlsp2d();
            
						}
		
		}else if(thnsel>0){
		 controlsp2d();
		}

		
		
		
        

 }



    function controlsp2d(){
		//alert("ee")
      var cspp = no_spp;  		
        var cskpd = document.getElementById('dn').value;
		  var jnss = document.getElementById('jns_beban').value; 
     // alert(cspp+" "+cskpd+"  "+jnss);
		$(document).ready(function(){
		$.ajax({
			type: "POST",
			dataType : 'json',
			data: ({no:cspp,skpd:cskpd,jns:jnss}),
			url: '<?php echo base_url(); ?>/index.php/tukd/control_sp2d',
			success:function(data){
                if (data!=9){
            
swal({
title:"<a style='font-size:large;'>Anggaran Rekening </a> <a style='color:red;font-size:large;'>"+data+"</a> <a style='font-size:large;'> sudah melebihi</a>" ,
text:"Cek Lagi Rekening",
html:true,
confirmButtonColor: "red",
type: "error",
timer: 10000,
confirmButtonText: "Ya",
showConfirmButton: true
});

				}else{

simpan_sp2d();
				}
			}
			});
		});
    }  
 
 
 
 
 
 
 
 
 
 

    function cek(){
        var lcno = document.getElementById('no_sp2d').value;
            if(lcno !=''){
               simpan_sp2d();               
            } else {
                alert('Nomor SP2D Tidak Boleh kosong')
                document.getElementById('no_sp2d').focus();
                exit();
            }
    }  
	
	function reaload_spm(){
			$('#nospm').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/nospmsp2d',  
                    idField:'no_spm',                    
                    textField:'no_spm',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_spm',title:'No',width:100},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:60},
                        {field:'tgl_spm',title:'Tgl SPM',align:'left',width:80} 
                          
                    ]],
                     onSelect:function(rowIndex,rowData){
                        no_spm = rowData.no_spm
                        tgspm = rowData.tgl_spm
                        no_spp = rowData.no_spp;         
                        dn  = rowData.kd_skpd;
                        sp  = rowData.no_spd;          
                        bl  = rowData.bulan;
                        tg  = rowData.tgl_spp;
                        jn  = rowData.jns_spp;
                        kep  = rowData.keperluan;
                        np  = rowData.npwp;
                        rekan  = rowData.nmrekan;
                        bk  = rowData.bank;
                        ning  = rowData.no_rek;
                        nm  = rowData.nm_skpd;        
                        get(no_spm,tgspm,no_spp,dn,sp,tg,bl,jn,kep,np,rekan,bk,ning,nm);
                       detail();
                       pot();                                                              
                    }  
                })
	}
	
    </script>
    <STYLE TYPE="text/css"> 
input.right{ 
         text-align:right; 
         } 
</STYLE> 

</head>
<body>



<div id="content">

<div id="accordion">

<!--<h3><a href="#" id="section1" onclick="javascript:$('#sp2d').edatagrid('reload')">List SP2D</a></h3>-->
<h3><a href="#" id="section1" >List SP2D</a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:section2();kosong();">Tambah</a>
        <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetak();">cetak</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <input id="icad" name="icad" type="text" readonly="true" style="width:150px ;"/>
        <table id="sp2d" title="List SP2D" style="width:870px;height:465px;" >  
        </table>
                  
        
    </p> 
    </div>

<h3><a href="#" id="section2" onclick="javascript:$('#dg').edatagrid('reload')" >Input SP2D</a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>
  <!-- <?php echo form_open('tukd/simpan', array('class' => 'basic')); ?> -->
               
<table border='1' style="font-size:11px" >

 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
 </tr>

 
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >No SP2D</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" name="no_sp2d" id="no_sp2d" onclick="javascript:select();"  style="width:200px ;"/><input type="text" name="no_sp2dx" id="no_sp2dx" onclick="javascript:select();"  style="width:100px ;" hidden/></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SP2D </td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="dd" name="dd" type="text" style="width:200px ;"/></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No SPM</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" name="nospm" id="nospm" style="width:200px ;" /></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SPM </td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="tgl_spm" name="tgl_spm" type="text" readonly="true" style="width:200px ;"/></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">   
   <td width="8%"  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >No SPP</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input id="nospp" name="nospp" style="width:200px" readonly="true" /></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SPP </td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="tgl_spp" name="tgl_spp" type="text" readonly="true" style="width:200px ;" /></td>   
    </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">SKPD</td>
   <td width="53%"  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >     
      <input id="dn" name="dn" style="width:200px" readonly="true"/></td> 
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bulan</td>
   <td width="31%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select  name="kebutuhan_bulan" id="kebutuhan_bulan" disabled="disabled" style="width:200px ;" >
     <option value="">...Pilih Kebutuhan Bulan... </option>
     <option value="1" >1 | Januari</option>
     <option value="2">2 | Februari</option>
     <option value="3">3 | Maret</option>
     <option value="4">4 | April</option>
     <option value="5">5 | Mei</option>
     <option value="6">6 | Juni</option>
     <option value="7">7 | Juli</option>
     <option value="8">8 | Agustus</option>
     <option value="9">9 | September</option>
     <option value="10">10 | Oktober</option>
     <option value="11">11 | November</option>
     <option value="12">12 | Desember</option>
   </select></td> 
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><textarea name="nmskpd" id="nmskpd" cols="40" rows="1" style="border: 0;"  readonly="true"></textarea></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Keperluan</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><textarea name="ketentuan" id="ketentuan" disabled="disabled" cols="30" rows="1" ></textarea></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No SPD</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input id="sp" name="sp" style="width:200px" readonly="true"/></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekanan</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><textarea id="rekanan" disabled="disabled" name="rekanan" cols="30" rows="1"  > </textarea></td>
 </tr>
 
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Beban</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><select name="jns_beban" id="jns_beban" disabled="disabled" style="width:200px;" >
     <option value="">...Pilih Jenis Beban... </option>
     <option value="1">UP</option>
     <option value="2">GU</option>
     <option value="3">TU</option>
     <option value="4">LS GAJI</option>
     <option value="5">LS PPKD</option>
     <option value="6">LS Barang Jasa</option>
     <option value="7">LS Bendahara</option>
   </select></td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bank</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><?php
								  		$bank1="select * from ms_bank ";
                                        $pagingquery1 = $bank1; //echo "edit  $pagingquery1<br />";
                                        $res = mysql_query($pagingquery1)or die("pagingquery gagal".mysql_error());
								?>
     <select name="bank1" id="bank1" disabled="disabled" style="height: 27px; width: 200px;">
       <option value="">...Bank.. </option>
       <?php
		 if($res)
          {
           while ($result = mysql_fetch_row($res)) 
             {
  		?>
       <option value="<?php echo $result[0]; ?>" <?php if($result[0]==$bank1){echo "selected";}?>> <?php echo $result[0]."-".$result[1]; ?> </option>
       <?php 
             }
           }
        ?>
     </select></td>
 </tr>
 <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">NPWP</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" disabled="disabled" name="npwp" id="npwp" value=""  style="width:200px ;"/></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekening</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input type="text" name="rekening" disabled="disabled" id="rekening"  value="" style="width:200px ;" /></td>
 </tr>
 
  <tr  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
  </tr>
       
 
     <tr  style="border-spacing: 3px;padding:3px 3px 3px 3px;">
                <td colspan="4" align="right"  style="border-bottom-color:black;border-spacing: 3px;padding:3px 3px 3px 3px;">
                <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Baru</a>
                <a id="save" class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:cekdulu();">Simpan</a>
                <a id="del" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hhapus();javascript:section1();">Hapus</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section1();">Kembali</a>                
                <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetak();">cetak</a></td>                
     </tr>
     
     </table>

    <table id="dg" title=" Detail SPM" style="width:850%;height:250%;" >  
    </table>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Total</B>&nbsp;&nbsp;<input class="right" type="text" name="rekspm" id="rekspm"  style="width:140px" align="right" readonly="true" >
        <input class="right" type="hidden" name="rekspm1" id="rekspm1"  style="width:100px" align="right" readonly="true" ><br />
        <table id="pot" title="List Potongan" style="width:850px;height:150px;" >  
        </table>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Total</B>&nbsp;&nbsp;<input class="right" type="text" name="rektotal" id="rektotal"  style="width:140px" align="right" readonly="true" >
    <!-- <?php echo form_close(); ?> -->
    

   </p>
    </div>
    

   
  
</div>

</div> 

<div id="dialog-modal" title="CETAK SP2D">
    <p class="validateTips">SILAHKAN PILIH SP2D</p> 
    <fieldset>
    <table>
        <tr>
            <td width="110px">NO SP2D:</td>
            <td><input id="csp2d" name="csp2d" style="width: 170px;" /></td>
        </tr>
        <tr>
            <td width="110px">Penandatangan:</td>
            <td><input id="ttd" name="ttd" style="width: 170px;" /></td>
        </tr>
       
    </table>  
    </fieldset>
    <a href="<?php echo site_url(); ?>/tukd/cetak_sp2d" class="easyui-linkbutton" plain="false" onclick="javascript:openWindow(this.href);return false;">Cetak</a>
	<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>  
</div>
 	
</body>

</h\
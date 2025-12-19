<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/demo/demo.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery-1.8.0.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>easyui/jquery.edatagrid.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/autoCurrency.js"></script>    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/numberFormat.js"></script>
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
    
	<script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">
     <style>    
    #tagih {
        position: relative;
        width: 500px;
        height: 70px;
        padding: 0.4em;
    }  
    </style>
    <script type="text/javascript">    
    var kode  = '';
    var giat  = '';
    var jenis = '';
    var nomor = '';
    var cid   = 0;
	var total1=0;
	var total0=0;
	var nokas='';
	var nokas1='';
    var cekit =0; 
	var cepot =0;
	var nosp2d ='';
	var ststagih=0;
	var cekidot=0;
	var hit=0;
	var status='';
	var sp2d='';
	var npwpx='';
     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
                height: 650,
                width: 1000,
                modal: true,
                autoOpen:false                
            });              
            $("#tagih").hide();
           // get_skpd();
        });    
     
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_suai',
        idField: 'id',            
                rownumbers: true, 
                fitColumns: true,
                singleSelect: true,
                autoRowHeight: true,
                loadMsg: "Tunggu Sebentar....!!",
                pagination: true,
				rowStyler:function(index,row){
        if (row.kondisi=='0'){
		 return 'background-color:#FCE6E6;';
        }
    },
                nowrap: true,
	
        columns:[[
    	 {field:'no_bukti',
    		title:'Nomor Bukti',
    		width:50},
            {field:'tgl_bukti',
    		title:'Tanggal',
    		width:30},
            {field:'total_d',
    		title:'Penerimaan',
    		width:50,
            align:"left"},
			{field:'total_k',
    		title:'Pengeluaran',
    		width:50,
            align:"left"},
            {field:'ket',
    		title:'Keterangan',
    		width:150,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor    = rowData.no_bukti;
          tgl_bukti      = rowData.tgl_bukti;
		   kd_skpd      = rowData.kd_skpd;
		    nm_skpd      = rowData.nm_skpd;
		    
			
			    total_d      = rowData.total_d;
				total_k      = rowData.total_k;
				
				  ket      = rowData.ket;
         
                       
      
		  cekit    =0;
		  cekidot    =0;
		  
		  
          get(nomor,tgl_bukti,kd_skpd,nm_skpd,total_d,total_k,ket);
        
		  $('#total1').attr('value',0);
		  $('#total0').attr('value',0);
		 
        },
        onDblClickRow:function(rowIndex,rowData){
	load_detail_a(nomor,kd_skpd);
		hit=1;
		section2();
		   
         

        }
    });
	
	 $('#oke').combobox({           
        valueField:'value',  
        textField:'label',        
        data: [{label: '1 || UP & GU',value: '0'},
               {label: '3 || TU',value: '1'},
			    {label: '7 || LS BENDAHARA',value: '7'}
               ],
        onSelect:function(rec){            
     
		}
		});
	
	
	 $('#ok').combobox({           
        valueField:'value',  
        textField:'label',        
        data: [{label: '0 || PENERIMAAN',value: '0'},
               {label: '1 || PENGELUARAN',value: '1'},
               ],
        onSelect:function(rec){            
     
		}
		});
    
 
 $(function(){
	$('#skpd').combogrid({  
		panelWidth:630,  
		idField:'kd_skpd',  
		textField:'kd_skpd',  
		mode:'remote',
		url:'<?php echo base_url(); ?>index.php/akuntansi/skpd',  
		columns:[[  
			{field:'kd_skpd',title:'Kode SKPD',width:100},  
			{field:'nm_skpd',title:'Nama SKPD',width:500}    
		]],
		onSelect:function(rowIndex,rowData){
			kdskpd = rowData.kd_skpd;
			$("#nmskpd").attr("value",rowData.nm_skpd);
			$("#skpd").attr("value",rowData.kd_skpd);
		//alert(hit);
		if(hit==0){
			ambil_nomor();
		}
		
			carigiat();
           
		}  
		}); 
	});
	
	
	$('#giat').combogrid({  
           panelWidth:700,  
           idField:'kd_kegiatan',  
           textField:'kd_kegiatan',  
           mode:'remote',
           
           columns:[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:140},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:700}
           ]]
               
        });
	
	
	function carigiat(){
         
		  var skpd=$('#skpd').combogrid("getValue");
		               //alert(skpd);       
        $('#giat').combogrid({  
           panelWidth:700,  
           idField:'kd_kegiatan',  
           textField:'kd_kegiatan',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/load_trskpdsuai',
           queryParams:({kd:skpd}),             
           columns:[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:140},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:700}
           ]],  
           onSelect:function(rowIndex,rowData){
               idxGiat = rowIndex;               
               giat = rowData.kd_kegiatan;
             
               var nomor = document.getElementById('nomor').value;
               var kode = document.getElementById('skpd').value;
               $("#nmrek").attr("value",'');
			   $("#nmgiat").attr("value",rowData.nm_kegiatan);
			    $("#rek").combogrid("setValue","");
                    $('#rek').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/load_suai_rek',
                                   queryParams:({giat:giat,kd:kode})
                                   });                                                                                                                                                   
           }  
        });
        
      
		}
        
    $('#dg1').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
			 rowStyler: function(index,row){
                		if (row.kondisi=='0'){
                			return 'background-color:#FCE6E6;';
                		}
                	},
			
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    nilx = rowData.nilai;
            },                                                     
            columns:[[
             {field:'no_bukti',title:'No Bukti', hidden:"true"},
			{field:'tgl_bukti',title:'tgl', hidden:"true"},
			{field:'kd_skpd',title:'kode skpd', hidden:"true"},
    	    {field:'kd_kegiatan',title:'Kegiatan',width:50},
            {field:'nm_kegiatan',title:'Nama Kegiatan', hidden:"true"},
            {field:'kd_rek5',title:'Kode Rekening',	width:30},
            {field:'nm_rek5',title:'Nama Rekening',	width:100,align:"left"},
            {field:'nilaid',title:'Penerimaan',width:70, align:"right"},
			{field:'nilaik',title:'Pengeluaran',width:70, align:"right"},
			{field:'kondisi',title:'P', hidden:"true"},
			{field:'ket',title:'keterangan', width:70},
			{field:'coke',title:'jenis beban', width:70}
			
           
            ]]
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
        
         $('#tglkas').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();    
            	return y+'-'+m+'-'+d;
            }
        });
        
		$('#tgl_kas').datebox({  
			required:true,
            formatter :function(date){
           	var y = date.getFullYear();
           	var m = date.getMonth()+1;
           	var d = date.getDate();
           	return y+'-'+m+'-'+d;
            },
            onSelect: function(date){
			jaka = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
		$('#tanggal').datebox('setValue',jaka);
	      }
        });
		
		
		
		
        
        $('#rek').combogrid({  
           panelWidth:650,  
           idField:'kd_rek5',  
           textField:'kd_rek5',  
           mode:'remote',                                   
           columns:[[  
               {field:'kd_rek5',title:'Kode Rekening',width:100,align:'center'},  
               {field:'nm_rek5',title:'Nama Rekening',width:550}
			  
           ]],
           onSelect:function(rowIndex,rowData){
               
				

               
				
                $('#nmrek').attr('value',rowData.nm_rek5);
                document.getElementById('nilai').select();
           }
        });                        
    });   
    
    function get_skpd(){
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
					$("#skpd").attr("value",data.kd_skpd);
					$("#nmskpd").attr("value",data.nm_skpd);
					npwpx = data.npwp;
					kode = data.kd_skpd;
					kegia();              
				}                                     
        	});  
        }
        
    function kegia(){
      $('#giat').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/load_trskpd',queryParams:({kd:kode,jenis:'52'})});  
    }     
  
  
  
    
    function set_grid(){
        $('#dg1').edatagrid({                                                                   
            columns:[[
            {field:'no_bukti',title:'No Bukti', hidden:"true"},
			{field:'tgl_bukti',title:'tgl', hidden:"true"},
			{field:'kd_skpd',title:'kode skpd', hidden:"true"},
    	    {field:'kd_kegiatan',title:'Kegiatan',width:50},
            {field:'nm_kegiatan',title:'Nama Kegiatan', hidden:"true"},
            {field:'kd_rek5',title:'Kode Rekening',	width:30},
            {field:'nm_rek5',title:'Nama Rekening',	width:100,align:"left"},
            {field:'nilaid',title:'DEBIT',width:70, align:"right"},
			{field:'nilaik',title:'KREDIT',width:70, align:"right"},
			{field:'kondisi',title:'P', hidden:"true"},
			{field:'ket',title:'keterangan', width:70},
			{field:'coke',title:'jenis beban', width:70}
            ]]
        });                 
    }
    
      
     function section1(){
         $(document).ready(function(){    
             $('#section1').click();                                               
         });
		   $('#total1').attr('value',0);
		  $('#total0').attr('value',0);
         set_grid();
         reload_data();         
     }

     function section2(){
         $(document).ready(function(){                
             $('#section2').click(); 
             document.getElementById("nomor").focus();                                              
         });                 
         set_grid();
     }
      
	   function  a(){
	    $("#giat").combogrid("enable");
		 $("#rek").combogrid("enable");
		 $('#ok').combobox('enable'); 
		  $('#oke').combobox('enable'); 
		 $("#nilai").attr("disabled",false); 
		 $("#keterangan").attr("disabled",false); 
		  $("#nomor").attr("enable",true);
	   }
	  
	  
    function get(nomor,tgl_bukti,kd_skpd,nm_skpd,total_d,total_k,ket)
		{
			hit=1;
			var cnomor= nomor;
		//$("#skpd").combogrid("setValue",kd_skpd);
		$("#skpd").combogrid("setValue",kd_skpd);  
 		 $("#nomor").attr("value",nomor);
		 $("#keterangan").attr("value",ket);
		 $("#tgl_kas").datebox("setValue",tgl_bukti);      
		 $("#giat").combogrid("disable");
		 //$("#rek").combogrid("disable");
		 $('#ok').combobox('disable'); 
		  $('#oke').combobox('disable'); 
		 $("#nilai").attr("disabled",true); 
		  $("#nomor").attr("disabled",true);

    }
    
   
    function tombolnew(){  
     $('#tambah').linkbutton('enable');
     $('#hapus').linkbutton('disable');
	 $("#c_simpan").linkbutton("disable");
	 $("#c_hapus").linkbutton("disable");
    }
    
    function kosong(){
		ambil_nomor();
		a();
		$('#total1').attr('value',0);
				$('#total0').attr('value',0);
        cdate = '<?php echo date("Y-m-d"); ?>';        
        $("#nomor").attr("value",'');
        $("#no_kas").attr("value",'');
		$("#nomorx").attr("value",'');
           $("#nmgiat").attr("value",'');   
		   $("#nmrek").attr("value",'');
		   $("#giat").combogrid("setValue",''); 
		   $("#rek").combogrid("setValue",'');
		    $('#ok').combobox('setValue',''); 
			$('#oke').combobox('setValue',''); 
			$("#nilai").attr("value",''); 
        $("#tgl_kas").datebox("setValue",cdate);
		
		
        $("#keterangan").attr("value",'');        
        
        $("#total").attr("value",'0');         
        
 

				
        
       
      

		
        
		$('#dg1').datagrid('loadData', {"total":0,"rows":[]});
        document.getElementById("nomor").focus();
        tombolnew(); 
		cekit=1;
		cekidot=1;
		
    }
    
    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_suai',
        queryParams:({cari:kriteria})
        });        
     });
    } 
    
   	 function load_detail_a(nomor,kd_skpd){        
        var kk = nomor;
		var skd=kd_skpd;
		
		//alert(kk+"  "+skd);
     
        //var cskpd = document.getElementById("skpd").value;//$('#skpd').combogrid('getValue');             
           $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/tukd/load_dsuai',
                data: ({no:kk,skd:skd}),
                dataType:"json",
                success:function(data){                                          
                    $.each(data,function(i,n){                                    
                    no_bukti      = n['no_bukti'];
                        tgl_bukti = n['tgl_bukti'];
                        kd_skpd= n['kd_skpd'];
                        kd_kegiatan = n['kd_kegiatan'];
                        nm_kegiatan = n['nm_kegiatan'];
                        kd_rek5 = n['kd_rek5'];
                        nm_rek5 = n['nm_rek5'];
                        nilaid= n['nilaid'];
						nilaik= n['nilaik'];
                        kondisi = n['kondisi'];
                        ket = n['ket'];
						 coke = n['beban'];
						
						 if (kondisi=='1'){
				   
                total1 = angka(document.getElementById('total1').value) + angka(nilaik);
                
				$('#total1').attr('value',total1);
			   }else{
				total0 = angka(document.getElementById('total0').value) + angka(nilaid);
                $('#total0').attr('value',total0);
				   }
						
						
                                                                                                      
                    $('#dg1').edatagrid('appendRow',{no_bukti:no_bukti,
				 								tgl_bukti:tgl_bukti,
												 kd_skpd:kd_skpd,
            									 kd_kegiatan:kd_kegiatan,
                                                 nm_kegiatan:nm_kegiatan,
                                                 kd_rek5:kd_rek5,
                                                 nm_rek5:nm_rek5,
                                                 nilaid:nilaid,
												 nilaik:nilaik,
												 kondisi:kondisi,
												 ket:ket,
												  coke:coke
                                                });
                    });                                                                           
                }
            });
           });                    
    }

	
        
    function append_save(){
		
		
        var no  	= document.getElementById('nomor').value;
		var tgl = $('#tgl_kas').datebox('getValue');
		var cskpd	= document.getElementById('skpd').value;
        var giat    = $('#giat').combogrid('getValue');
		var nmgiat  = document.getElementById('nmgiat').value; 
        var rek     = $('#rek').combogrid('getValue');
        var nmrek   = document.getElementById('nmrek').value;
        var nil     = document.getElementById('nilai').value;
		var nul='0';
		var cok 	= $('#ok').combobox('getValue');
		var coke 	= $('#oke').combobox('getValue');
		var ket     = document.getElementById('keterangan').value; 
		aas = angka(nil);



            if (giat != '' && nil != 0) {
				
				if (cok=='0'){
                 $('#dg1').edatagrid('appendRow',{no_bukti:no,
				 								tgl_bukti:tgl,
												 kd_skpd:cskpd,
            									 kd_kegiatan:giat,
                                                 nm_kegiatan:nmgiat,
                                                 kd_rek5:rek,
                                                 nm_rek5:nmrek,
                                                 nilaid:nil,
												 nilaik:nul,
												 kondisi:cok,
												 ket:ket,
												 coke:coke
                                                });
			}else{			
			 $('#dg1').edatagrid('appendRow',{no_bukti:no,
				 								tgl_bukti:tgl,
												 kd_skpd:cskpd,
            									 kd_kegiatan:giat,
                                                 nm_kegiatan:nmgiat,
                                                 kd_rek5:rek,
                                                 nm_rek5:nmrek,
                                                 nilaid:nul,
												 nilaik:nil,
												 kondisi:cok,
												 ket:ket,
												 coke:coke
                                                });
			
			}
												
												
	 $('#hapus').linkbutton('enable');
	 $("#c_simpan").linkbutton("enable");
	 $("#c_hapus").linkbutton("enable");	
	            $("#nmgiat").attr("value",'');   
		   $("#nmrek").attr("value",'');
		   $("#giat").combogrid("setValue",''); 
		   $("#rek").combogrid("setValue",'');
		    $('#ok').combobox('setValue','');
			$('#oke').combobox('setValue','');   
			$("#nilai").attr("value",'');					

                                                               
               if (cok=='1'){
				   
                total1 = angka(document.getElementById('total1').value) + angka(nil);
                
				$('#total1').attr('value',total1);
			   }else{
				total0 = angka(document.getElementById('total0').value) + angka(nil);
                $('#total0').attr('value',total0);
				   }
		 
		 
        } else {
            alert('Kode Kegiatan,Nilai dan Anggaran tidak boleh kosong');
            exit();                
        }     
    }  
    
    function validate_rekening(){
           $('#dgpajak').datagrid('selectAll');
           var rows = $('#dgpajak').datagrid('getSelections');                
           frek  = '' ;
           rek5  = '' ;
           for ( var p=0; p < rows.length; p++ ) { 
           rek5 = rows[p].kd_rek5;                                       
           if ( p > 0 ){   
                  frek = frek+','+rek5;
              } else {
                  frek = rek5;
              }
           }
           
           $(function(){
           $('#rekpajak').combogrid({  
                   panelWidth  : 700,  
                   idField     : 'kd_rek5',  
                   textField   : 'kd_rek5',  
                   mode        : 'remote',
                   url         : '<?php echo base_url(); ?>index.php/tukd/rek_pot_ar', 
                   queryParams :({kdrek:frek}), 
                   columns:[[  
                       {field:'kd_rek5',title:'Kode Rekening',width:100},  
                       {field:'nm_rek5',title:'Nama Rekening',width:700}    
                   ]],  
                   onSelect:function(rowIndex,rowData){
                       $("#nmrekpajak").attr("value",rowData.nm_rek5.toUpperCase());
                   }  
                   });
                   });
          $('#dgpajak').datagrid('unselectAll');         
    }   
    
    function tambah(){
		
        var nor = document.getElementById('nomor').value;
        var tot = document.getElementById('total').value;
        var kd = document.getElementById('skpd').value;
		var tgl = $('#tgl_kas').datebox('getValue');
		var cok = $('#ok').combobox('getValue');
		var coke = $('#oke').combobox('getValue');
		 
        $('#dg2').edatagrid('reload');
        $('#total1').attr('value',tot);
        $('#giat').combogrid('setValue','');
      	
        $('#rek').combogrid('setValue','');
      
  
	
		
        if (kd != '' && tgl != '' && nor !=''){            
            $("#dialog-modal").dialog('open'); 
            load_detail2();           
        } else {
            alert('Harap Isi Kode SKPD, Tanggal Transaksi, Jenis Beban, Jenis Pembayaran') ;         
        }
    }

	function ambil_nomor(){
//		alert("aa");
			var skpd=$('#skpd').combogrid("getValue");
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>/index.php/tukd/nsuai',
			data: ({skpd:skpd}),
			dataType:"json",
				success: function(data){
				
				$("#nomor").attr("value",data.nomor);
				//$("#nomorx").attr("value",data.bukti);
			}
		});
	}
	
	
   
    function keluar(){
        $("#dialog-modal").dialog('close');
        $('#dg2').edatagrid('reload');
        kosong2();                        
    }   
     
    function hapus_giat(){
         var rows = $('#dg1').edatagrid('getSelected');
		 cnild = rows.nilaid;
		 		 cnilk = rows.nilaik;
         ckondisi=rows.kondisi;
		 var tot0 = angka(document.getElementById('total0').value);
		 var tot1 = angka(document.getElementById('total1').value);
         
		 
		 if(ckondisi=='0'){ 
		 tot3 = tot0 - angka(cnild);
		 $('#total0').attr('value',tot3);        
		 }else{
         tot4 = tot1 - angka(cnilk);
		 $('#total1').attr('value',tot4);        
		 }
		 $('#dg1').datagrid('deleteRow',idx);              
    }
    
     function hapus(){
        var cnomor = document.getElementById('nomor').value;
		var skpd=$('#skpd').combogrid("getValue");
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_suai';
		swal({
		  title:"<a style='font-size:large;'>HAPUS NO:</a> <a style='color:red;font-size:large;'>"+cnomor+"</a> <a style='font-size:large;'></a>" ,
		  text: "Apakah Anda Yakin Akan Menghapus!",
		  type: "warning",
		  html:true,
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Ya!",
		  cancelButtonText: "Tidak",
		  closeOnConfirm: true,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
			$(document).ready(function(){
			$.ajax({url:urll,
					 dataType:'json',
					 type: "POST",    
					 data:({no:cnomor,skpd:skpd}),
					 success:function(data){
							status = data.pesan;
							if (status=='1'){
								swal("TERHAPUS!", "Data berhasil di Hapus", "success"); 
								section1();
							} else {
								swal("Oops...", "Something went wrong!", "error");
							}        
					 }
					 
					});           
			});
		  } 
		});   
    }
    

 	function simpan_suai(){
		
	  var nomor = document.getElementById('nomor').value;
	   
	  var ctgl  = $('#tgl_kas').datebox('getValue');
	  var kd = document.getElementById('skpd').value;
	
	   var ket = document.getElementById('keterangan').value;
	  	
		var tot0 = angka(document.getElementById('total0').value);
		var tot1 = angka(document.getElementById('total1').value);
		// var ctgl  = $('#tanggal').datebox('getValue');
		
		if(tot0!=tot1){
			swal("Oops...", "nilai tidak sama!", "error");
			exit();
			}
	
		//alert(nomor+"   "+ctgl+"    "+kd+"    "+ket+"  "+tot0+"   "+tot1);
		 $(document).ready(function(){
			$.ajax({
                type: "POST",       
                dataType : 'json',         
                 data: ({tabel:'hkoreksi',nomor:nomor,ctgl:ctgl,kd:kd,ket:ket,db:tot0,kr:tot1}),
                url: '<?php echo base_url(); ?>/index.php/tukd/simpan_suai',
                success:function(data){
                    status = data.pesan;
                }
            });
        });
		
		  if (status=='0'){
           alert('Gagal Simpan !');
           exit();
		   
		  
        }
		
		
		
		
	//	alert('aaa');
		
		
		 $('#dg1').datagrid('selectAll');
            var rows = $('#dg1').datagrid('getSelections'); 
			         
			for(var p=0;p<rows.length;p++){
				cnobukti = rows[p].no_bukti;
				
				//ctgl  = rows[p].tgl_bukti;
				 
                cskpd  = rows[p].kd_skpd;
				 
                ckdgiat  = rows[p].kd_kegiatan;
               
				cnmgiat  = rows[p].nm_kegiatan;
              
				crek     = rows[p].kd_rek5;
               
				cnmrek   = rows[p].nm_rek5;
          
				cnilaid   = angka(rows[p].nilaid);
			
				cnilaik   = angka(rows[p].nilaik);
				
				ckn   = rows[p].kondisi;
				coke   = rows[p].coke;
				
				//cket     = rows[p].ket;

				if (p>0) {
                csql = csql+","+"('"+cnobukti+"','"+ctgl+"','"+cskpd+"','"+ckdgiat+"','"+cnmgiat+"','"+crek+"','"+cnmrek+"','"+cnilaid+"','"+cnilaik+"','"+ckn+"','"+ket+"','"+coke+"')";
                } else {
                csql = "values('"+cnobukti+"','"+ctgl+"','"+cskpd+"','"+ckdgiat+"','"+cnmgiat+"','"+crek+"','"+cnmrek+"','"+cnilaid+"','"+cnilaik+"','"+ckn+"','"+ket+"','"+coke+"')";                                            
                }      
				
				                                       
			}                     
            $(document).ready(function(){
                $.ajax({
                    type: "POST",   
                    dataType : 'json',                 
                    data: ({tabel:'dkoreksi',sql:csql,nomor:nomor,kd:kd}),
                    url: '<?php echo base_url(); ?>/index.php/tukd/simpan_suai',
                    success:function(data){                        
                        status = data.pesan; 
 if (status=='1'){               
						swal({
			  title: 'Tersimpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#00ff66",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});						
                    }else{
									
							swal({
			  title: 'Gagal Simpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "error",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
						
						
					}
					}
                });
                });         
	}
    

	
	
     function runEffect() {
        var selectedEffect = 'blind';            
        var options = {};                      
        $( "#tagih" ).toggle( selectedEffect, options, 500 );
        $("#notagih").combogrid("setValue",'');
        $("#tgltagih").attr("value",'');
        $("#keterangan").attr("value",'');
        $("#beban").attr("value",'');
        load_detail_baru();
    };  
	
	
	            

     
    function cek(){
        var lcno = document.getElementById('nomor').value;
            if ( lcno !='' ) {
               section3();  
               $("#totalrekpajak").attr("value",0);  
               $("#nilairekpajak").attr("value",0);  
               tampil_potongan();          
               load_sum_pot();
               $("#rekpajak").combogrid("setValue",'');
               $("#nmrekpajak").attr("value",'');
               
            } else {
                alert('Nomor  Tidak Boleh kosong')
                document.getElementById('no_spm').focus();
                exit();
            }
    }
    
     
    function reload_data() {
      $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_suai',
        idField: 'id',            
                rownumbers: true, 
                fitColumns: true,
                singleSelect: true,
                autoRowHeight: true,
                loadMsg: "Tunggu Sebentar....!!",
                pagination: true,
				rowStyler:function(index,row){
        if (row.kondisi=='0'){
		 return 'background-color:#FCE6E6;';
        }
    },
                nowrap: true,
	
        columns:[[
    	 {field:'no_bukti',
    		title:'Nomor Bukti',
    		width:50},
            {field:'tgl_bukti',
    		title:'Tanggal',
    		width:30},
            {field:'total_d',
    		title:'Penerimaan',
    		width:50,
            align:"left"},
			{field:'total_k',
    		title:'Pengeluaran',
    		width:50,
            align:"left"},
            {field:'ket',
    		title:'Keterangan',
    		width:150,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomor    = rowData.no_bukti;
          tgl_bukti      = rowData.tgl_bukti;
		   kd_skpd      = rowData.kd_skpd;
		    nm_skpd      = rowData.nm_skpd;
		    
			
			    total_d      = rowData.total_d;
				total_k      = rowData.total_k;
				
				  ket      = rowData.ket;
         
                       
      
		  cekit    =0;
		  cekidot    =0;
		  
		  
          get(nomor,tgl_bukti,kd_skpd,nm_skpd,total_d,total_k,ket);
        
		  $('#total1').attr('value',0);
		  $('#total0').attr('value',0);
		 
        },
        onDblClickRow:function(rowIndex,rowData){
	load_detail_a(nomor,kd_skpd);
		
		section2();
		   
         

        }
    });

    }

	function kim(){
		$("#no_kas").attr("value",'');
		$("#nomor").attr("value",'');
		$("#nomorx").attr("value",'');
		
	}
	
	
</script>

</head>
<body>
<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1" >List Koreksi</a></h3>
    <div>
    <p align="left">&nbsp;</p>
    <p align="right">
      
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:section2();kosong();">Tambah</a>           
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"  onkeypress="javascript:cari();"/>
        <table id="dg" title="List Pembayaran Transaksi" style="width:870px;height:450px;" >  
        </table>                          
    </p> 
    </div>   

<h3><a href="#" id="section2">KOREKSI</a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>       
   <div id="demo"></div>
        <table align="center" style="width:100%;">
            <tr>
                <td colspan="5">&nbsp;</td>                
            </tr>
            <tr>
                <td>No. Bukti</td>
                <td><input type="text" id="nomor" style="width: 200px;" onclick="javascript:select();" readonly/><input type="text" id="nomorx" style="width: 200px;" onclick="javascript:select();" hidden /></td>
                <td>&nbsp;</td>
                <td> Tanggal bukti
                  <input type="text" id="tgl_kas" style="width: 140px;" /> </td>
                  
            </tr>  
           
            <tr>
                <td>S K P D</td>
                <td colspan="3"><input id="skpd" name="skpd" style="width: 140px;"readonly />
               &nbsp;
                <input type="text" id="nmskpd" style="border:0;width: 400px;" readonly="true"/>
                
                </td>
               
              
                                             
            </tr>
  <tr>
            <td>Kode Kegiatan</td>
        
            <td colspan="3" width="300"><input id="giat" name="giat" style="width: 200px;" />&nbsp;
            <input type="text" id="nmgiat" readonly="true" style="border:0;width: 400px;"/>
            
            </td>
       
        </tr>        
       
         <tr>
            <td >Kode Rekening</td>
         
            <td colspan="3"><input id="rek" name="rek" style="width: 200px;" />
          
        &nbsp;
            <input type="text" id="nmrek" readonly="true" style="border:0;width: 400px;"/></td>
        </tr>
		<tr>
                <td>JENIS</td>
                <td><input id="ok" name="ok"  style="width: 140px; border:0;" /></td>
                </tr> 
                
                <tr>
                <td>JENIS BEBAN</td>
                <td><input id="oke" name="oke"  style="width: 140px; border:0;" /></td>
                </tr> 
        <tr>
            <td >Nilai</td>
       
            <td><input type="text" id="nilai" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))" onkeyup="javascript:sisa_bayar();"/></td>            
        </tr>                 




       
            <tr>
                <td>Keterangan</td>
                <td colspan="4"><textarea id="keterangan" style="width: 650px; height: 40px;"></textarea></td>
           </tr>            
            
        </table>  
        <div id="toolbar" align="right">
    		<a id="tambah" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:append_save();">Tambah Detail</a>
   		    <!--<input type="checkbox" id="semua" value="1" /><a onclick="">Semua Kegiatan</a>-->
            <a id="hapus" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus_giat();">Hapus Kegiatan</a>
               		
        </div>        
        <table id="dg1" title="Rekening" style="width:870px;height:450px;" >  
        </table>
        <table align="center" style="width:100%;">
          <tr>
            <td ></td>
            <td align="right">Total penerimaan :
              <input type="text" id="total0" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></td>
            <td>&nbsp;</td>
            <td ></td>
            <td align="right">Total Pengeluaran :
              <input type="text" id="total1" style="text-align: right;border:0;width: 200px;font-size: large;" readonly="true"/></td>
          </tr>
          <tr>
                <td colspan="5" align="center"><a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Baru</a>
                    <a class="easyui-linkbutton" id="c_simpan" iconCls="icon-save" plain="false" onclick="javascript:simpan_suai();">Simpan</a>
                    <!--<a id="poto" class="easyui-linkbutton" iconCls="icon-redo" plain="false" onclick="javascript:cek();">Potongan</a>-->
		            <a class="easyui-linkbutton" id="c_hapus" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>
  		            <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:kim();javascript:section1();">Kembali</a>                                    
                </td>
            </tr>
        </table>
      </p>
   </div>
   
   
</div>
</div>



<?php $this->load->view('inc/jr-set.php'); ?>
</body>
</html>
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
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.maskMoney.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/lib/sweet-alert.css">
    
    
    <link href="<?php echo base_url(); ?>easyui/jquery-ui.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url(); ?>easyui/jquery-ui.min.js"></script>
   
    <script type="text/javascript"> 
   
    var no_spp   = '';
    var kode     = '';
    var lcstatus = '';

        $(document).ready(function() {
            $("#accordion").accordion();
            $("#lockscreen").hide();                        
            $("#frm").hide();
            $( "#dialog-modal" ).dialog({
            height: 200,
            width: 700,
            modal: true,
            autoOpen:false
        });
        get_skpd();
		$('#hal').attr("value",0);
		cekup();
        });
           
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
   	
            

$(document).ready(function(){
      $('#nilaiup').maskMoney({thousands:',', decimal:'.', precision:0});
	   $('#nilaispd').maskMoney({thousands:',', decimal:'.', precision:0});
    });

            $('#cspp').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/load_spp_up',  
                    idField:'no_spp',                    
                    textField:'no_spp',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_spp',title:'SPP',width:60},  
						{field:'no_spm',title:'SPM',width:60},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:60},
                        {field:'tgl_spp',title:'Tanggal',width:60} 
                          
                    ]],
                    onSelect:function(rowIndex,rowData){
                    nomer = rowData.no_spp;
                    kode = rowData.kd_skpd;
                    jns = rowData.jns_spp;
                    val_ttd(kode);
                    }   
                });
                
        
        $('#spp').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_spp_up',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
		rowStyler: function(index,row){
				if (row.sss>0){
					return 'background-color:#FFFF00;';
				}
			},
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'no_spp',
    		title:'NO SPP',
    		width:40},
			{field:'no_spm',title:'SPM',width:60},  
            {field:'tgl_spp',
    		title:'Tanggal',
    		width:25},
            {field:'nm_skpd',
    		title:'Nama SKPD',
    		width:25,
            align:"left"},
            {field:'keperluan',
    		title:'Keterangan',
    		width:140,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){
          nomer   = rowData.no_spp; 
		  nomerspm= rowData.no_spm;         
          kode    = rowData.kd_skpd;
          spd     = rowData.no_spd;
          tg      = rowData.tgl_spp;
          jn      = rowData.jns_spp;
          kep     = rowData.keperluan;
          np      = rowData.npwp;          
          bk      = rowData.bank;
		  bulan      = rowData.bulan;
          ning    = rowData.no_rek;
          status  = rowData.status;
		            sss  = rowData.sss;
					
			w  = rowData.a;		
			x  = rowData.b;
			y  = rowData.c;
			z  = rowData.d;
			
								
		  rekanan = rowData.nmrekan;         
		  pim = rowData.pimpinan;         
          get(nomer,kode,spd,tg,jn,kep,np,bk,ning,status,rekanan,pim,bulan,nomerspm,sss,w,x,y,z);
          detail1_up(); 
          lcstatus = 'edit';                                           
        },
        onDblClickRow:function(rowIndex,rowData){
            section1();
			$("#satu").attr("disabled",true);
$("#tiga").attr("disabled",true);
        }
        });
 
 
 
 $('#ttd').combogrid({  
                panelWidth:500,  
               // url: '<?php echo base_url(); ?>/index.php/tukd/pilih_ttd2/'+dns,  
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
         $('#sp').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/spd3',                
                    idField:'no_spd',  
                    textField:'no_spd',
                    mode:'remote',  
                    fitColumns:true,
                    onLoadSuccess:function(data){
                      detail1_up();                                           
                    },                    
                    columns:[[  
                        {field:'no_spd',title:'No SPD',width:30},  
                        {field:'tgl_spd',title:'Tanggal',align:'left',width:40},
						{field:'total',title:'Total',align:'left',width:30},
						{field:'h',title:'Sisa',align:'left',width:30}						
                    ]],
                    onSelect:function(rowIndex,rowData){
                    spd = rowData.no_spd;
                    nilspd = rowData.total;
					n = rowData.nilai;
					h = rowData.h;
					
					$("#nilaispd").attr("value",number_format(h,0,'.',','));
                                                                        
                    }    
                });                
         
         $('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                 autoRowHeight:"true",
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 singleSelect:"true",
			});
            
        
         $('#rekup').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/spd1_up',                
                    idField    : 'kdrek5',  
                    textField  : 'kdrek5',
                    mode       : 'remote',  
                    fitColumns : true,
                    columns:[[  
                        {field:'kdrek5',title:'Kode Rekening',width:50},  
                        {field:'nmrek5',title:'Nama Rekening',align:'left',width:100}                          
                    ]],
                    onSelect:function(rowIndex,rowData){
                        $("#nmrekup").attr("value",rowData.nmrek5) ;                   
                    }    
                });            
        });

        function val_ttd2(dns){
           $(function(){
            $('#ttd2').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_ttd/'+dns,  
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
   
    function get_skpd()
        {
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/rka/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
        								$("#dn").attr("value",data.kd_skpd);
        								$("#nmskpd").attr("value",data.nm_skpd);
										$("#npwp").attr("value",data.npwp);
										$("#rekening").attr("value",data.rekening);
										$("#bank1").attr("value",data.bank);
        								kode = data.kd_skpd;
                                        validate_spd(kode); 
										val_ttd(kode);		
										bendahara(kode);								
        							  }                                     
        	});  
        }   
    
       

 function bendahara(skpd){
	var skpd=skpd;

  $.ajax({
    type: "POST",
    url: '<?php echo base_url(); ?>/index.php/tukd/benda',
    data: ({skpd:skpd}),
    dataType:"json",
    success: function(data){
ibend=data.bendahara;
//alert(ibend);
     // $("#xtc").attr("value",ibend);
   $("#rekanan").attr("Value",ibend);
    }
  });
}	   
	    
    
    function validate_spd(kode){
           $(function(){
            $('#sp').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/spd3/'+kode,  
                    idField:'no_spd',  
                    textField:'no_spd',
                    mode:'remote',  
                    fitColumns:true
			    });
           });
        }
    
    function detail1_up(){
        
            var no_spp = document.getElementById('no_spp').value;
            
            $.ajax({
        		url      : '<?php echo base_url(); ?>/index.php/tukd/select_data1',
        		type     : "POST",
                data     : ({spp:no_spp}),
        		dataType : "json",                         
        		success  : function(data){
                $.each(data, function(i,n){
					nnn=n['nilai1'];
                $("#rekup").combogrid("setValue",n['kdrek5']);
                $("#nmrekup").attr("Value",n['nmrek5']);
                $("#nilaiup").attr("Value",nnn);
                });
                }                                     
        	});  
            
    }

    function detail1(){
        
	   	    var no_spp = document.getElementById('no_spp').value;  
			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams:({spp:no_spp}),
                 idField       : 'idx',
                 toolbar       : "#toolbar",              
                 rownumbers    : "true", 
                 fitColumns    : false,
                 autoRowHeight : "true",
                 singleSelect  : false,
                 onLoadSuccess : function(data){                      
                      load_sum_spp();                        
                    },
                onSelect:function(rowIndex,rowData){
                kd = rowIndex;                                               
                },   
                 onAfterEdit:function(rowIndex, rowData, changes){
								kd_rek5=rowData.kdrek5;
                                nm_rek5=rowData.nmrek5;
                                nilai=rowData.nilai1;
                                kd=rowIndex;
								dsimpan(kd_rek5,nm_rek5,nilai,kd);       	                                  
							 },                			 				 
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},
					{field:'kdrek5',
					 title:'Rekening',
					 width:100,
					 align:'left'
					},
					{field:'nmrek5',
					 title:'Nama Rekening',
					 width:530
					},
                    {field:'nilai1',
					 title:'Nilai',
					 width:140,
                     align:'right',
					 editor:{type:"numberbox"					     
							} 
                     }
				]]	
			});
        
        }
        
        
        function detail(){
        $(function(){
	   	    var no_spp = '';            
			$('#dg1').edatagrid({
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
					{field:'kdrek5',
					 title:'Rekening',
					 width:100,
					 align:'left'
					},
					{field:'nmrek5',
					 title:'Nama Rekening',
					 width:530
					},
                    {field:'nilai1',
					 title:'Nilai',
					 width:140,
                     align:'right',
					 editor:{type:"numberbox"					     
							} 
                     }
				]]	
			});
		});
        }
        
        function get(no_spp,kd_skpd,no_spd,tgl_spp,jns_spp,keperluan,npwp,bank,rekening,status,rekanan,pim,bulan,nomerspm,sss,w,x,y,z){
       
	   //alert(w+""+x+""+y+""+z);
	   
	   $("#satu").attr("value",w);
	   $("#dua").attr("value",x);
	   $("#tiga").attr("value",y);
	   $("#empat").attr("value",z);
	   
	    $("#no_spp").attr("value",no_spp);
		 $("#no_spm").attr("value",nomerspm);
        $("#no_spp_hide").attr("value",no_spp);       
        $("#dn").attr("Value",kd_skpd);
        $("#sp").combogrid("setValue",no_spd);
        $("#dd").datebox("setValue",tgl_spp);        
        $("#ketentuan").attr("Value",keperluan);
        $("#jns_beban").attr("Value",jns_spp);
        $("#npwp").attr("Value",npwp);       
        $("#bank1").attr("Value",bank);
        $("#rekening").attr("Value",rekening);
		$("#kebutuhan_bulan").attr("Value",bulan);
		$("#rekanan").attr("Value",rekanan);
        $("#dir").attr("Value",pim);
        tombol(sss);           
        }
		
        function kosong(){
           var cdate='<?php echo date('Y-m-d');?>';
            lcstatus = 'tambah'; 
			ambil_nomor();
			$("#satu").attr("disabled",false);
$("#tiga").attr("disabled",false);
			$("#rekup").combogrid("setValue",1110302);
            $('#save').linkbutton('enable');
            $('#del').linkbutton('enable');
            $('#sav').linkbutton('enable');
            $('#dele').linkbutton('enable');             
            $("#no_spp").attr("value",'');
			$("#no_spm").attr("value",'');
            $("#no_spp_hide").attr("value",'');
            
			
			$("#satu").attr("value","");
			$("#dua").attr("value","");
			$("#tiga").attr("value","");
			$("#empat").attr("value","");
	   
           
            $("#nilaiup").attr("Value",0);
			$("#kebutuhan_bulan").attr("Value",'');
            $("#sp").combogrid("setValue",'');
            $("#dd").datebox("setValue",cdate);        
            $("#ketentuan").attr("Value",'UP');
            $("#jns_beban").attr("Value",1);
            $("#nilaispd").attr("Value",'');
			//$("#rekanan").attr("Value",'');
        $("#dir").attr("Value",'');
            document.getElementById("p1").innerHTML="";
            document.getElementById("no_spp").focus();
            $("#sp").combogrid("clear");
			$('#sp').combogrid({url:'<?php echo base_url(); ?>/index.php/tukd/spd3',
                    
                                   });
            detail();
                    
        }

		function getRowIndex(target){  
			var tr = $(target).closest('tr.datagrid-row');  
			return parseInt(tr.attr('datagrid-row-index'));  
		} 
              
    
       
     function cetak(){
        var nom=document.getElementById("no_spp").value;
        $("#cspp").combogrid("setValue",nom);
        $("#dialog-modal").dialog('open');
    } 
    
    function keluar(){
        $("#dialog-modal").dialog('close');
    }   
     function cari(){
     var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
            $('#spp').edatagrid({
	       url: '<?php echo base_url(); ?>/index.php/tukd/load_spp',
         queryParams:({cari:kriteria})
        });        
     });
    }
     
     function setgrid(){
       $('#dg1').edatagrid({			  			 				 
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},
					{field:'kdrek5',
					 title:'Rekening',
					 width:100,
					 align:'left'
					},
					{field:'nmrek5',
					 title:'Nama Rekening',
					 width:530
					},
                    {field:'nilai1',
					 title:'Nilai',
					 width:140,
                     align:'right',
					 editor:{type:"numberbox"					     
							} 
                     }
                      
				]]
                });
     }  
      
     
     function section1(){
         $(document).ready(function(){    
             $('#section1').click();                                             
         });
     }
     
     function section4(){
         $(document).ready(function(){    
             $('#section4').click();                                               
         });
     }
     
	 
	 function cek_nomer(){
	 var aspm       = document.getElementById('no_spm').value;
        var a       = document.getElementById('no_spp').value;
		
		if (aspm==''){
			alert("NO SPM TIDAK BOLEH KOSONG !!!");
			exit();
			}
			
		if (a==''){
			alert("NO SPP TIDAK BOLEH KOSONG !!!");
			exit();
			}
			
	 $(document).ready(function(){
					$.post(urll,({spm:aspm,spp:a}),
						function(data){
							status = data; 
							if (data != '8'){
						//alert(data);
						
					swal({
			  title: 'No Sudah Ada..!!',
			  text: "Cek Ulang atau Ganti No SPM",
			   confirmButtonText: "Ya",
			   type: "error",
			  showConfirmButton: true
			});
			exit();
				
							}
						
						});
                    });	
	 }
	 
	  function ceknospmspp(){
		 // alert(lcstatus);
		var aspm       = document.getElementById('no_spm').value;
        var a       = document.getElementById('no_spp').value;
		
		var s       = document.getElementById('satu').value;
        var t       = document.getElementById('tiga').value;
		//var k       = angka(document.getElementById('rektotal1_ls').value);
		//var tt = $('#notagih').combogrid('getValue');
		
		
		xa=s.length
		xb=t.length
		
		
		 if(xa!=4){
				swal({
			  title: 'NOMOR HARUS 4 DIGIT..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			}); 
			exit();
				 	 
				 }
				 		 if(xb!=4){
				swal({
			  title: 'NOMOR HARUS 4 DIGIT..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			}); 
			exit();
				 	 
				 }
		
		
		if(s==''){
				  swal({
			  title: 'Isi dulu no SPP..!!',
			  text: "Cek Ulang",
			   confirmButtonText: "Ya",
			   type: "error",
			  showConfirmButton: true
			});
			exit();
			}

if(t==''){
				  swal({
			  title: 'Isi dulu no SPM..!!',
			  text: "Cek Ulang",
			   confirmButtonText: "Ya",
			   type: "error",
			  showConfirmButton: true
			});
			exit();
			}





		if(a==''){
				  swal({
			  title: 'Isi dulu no SPP..!!',
			  text: "Cek Ulang",
			   confirmButtonText: "Ya",
			   type: "error",
			  showConfirmButton: true
			});
			exit();
			}


		if(aspm==''){
				  swal({
			  title: 'Isi dulu no spm..!!',
			  text: "Cek Ulang",
			   confirmButtonText: "Ya",
			   type: "error",
			  showConfirmButton: true
			});
			exit();
			}

		var urll= '<?php echo base_url(); ?>/index.php/tukd/cek_nospp_spm';   

if (lcstatus=='tambah') { 
					$(document).ready(function(){
					$.post(urll,({spm:aspm,spp:a}),
						function(data){
							status = data; 
							if (data == '8'){
						//alert(data);
						
						hsimpan();
				
							}else{
								
								  swal({
			  title: 'No Sudah Ada..!!',
			  text: "Cek Ulang atau Ganti No SPP",
			   confirmButtonText: "Ya",
			   type: "error",
			  showConfirmButton: true
			});
			exit()
								}
						
						});
                    });	
					
					
}else{
	//alert(lcstatus);
	hsimpan();
	
	}
		 
		 }
		 
		 
		 
		 
		 
		 
		   function cekup(){
var urll= '<?php echo base_url(); ?>/index.php/tukd/cek_upnya';   
			$(document).ready(function(){
					$.post(urll,({}),
						function(data){
							status = data; 
							//alert(status);
							
							if(status>0){
								//alert("sadasdasdsad");
								 $('#tambah').linkbutton('enable');
								}else{
									 $('#tambah').linkbutton('disable');
									
									}
						});
                    });	
					
					

		 
		 }
		 
		 
	 
     
     function hsimpan(){        
        
		var aspm      = document.getElementById('no_spm').value;
        var a       = document.getElementById('no_spp').value;
        var a_hide  = document.getElementById('no_spp_hide').value;      
        var b       = $('#dd').datebox('getValue');      
        var c       = document.getElementById('jns_beban').value;
	    var d       = document.getElementById('kebutuhan_bulan').value;        
        var e       = document.getElementById('ketentuan').value;       
        var g       = document.getElementById('bank1').value;
        var h       = document.getElementById('npwp').value;
        var i       = document.getElementById('rekening').value;
        var j       = document.getElementById('nmskpd').value;         
        var k       = document.getElementById('nilaiup').value;
        var spd1     = document.getElementById('nilaispd').value;
	    var f       = document.getElementById('rekanan').value;
        var f1      = document.getElementById('dir').value;
		var user    ='<?php echo $this->session->userdata('pcNama'); ?>';
		var update  ='<?php echo date('Y-m-d H:m:s'); ?>';
		k = angka(k);
        
		var satu = document.getElementById('satu').value;
		var tiga = document.getElementById('tiga').value;
		
		xx=satu.length
		xy=tiga.length
		

		$("#satu").attr("disabled",true);
$("#tiga").attr("disabled",true);
        if (lcstatus=='tambah') { 
            lcinsert = "(no_spp,  kd_skpd,   keperluan, bulan,    no_spd,  jns_spp,     bank,    nmrekan,    no_rek,     npwp,    nm_skpd,  tgl_spp, status, username,     last_update,   nilai,   no_bukti, kd_kegiatan,  nm_kegiatan,  kd_program,  nm_program,  pimpinan,  no_tagih,    tgl_tagih,  sts_tagih, no_bukti2, no_bukti3, no_bukti4, no_bukti5, no_spd2, no_spd3, no_spd4,no_spm,SUMBER )"; 
            lcvalues = "('"+a+"', '"+kode+"', '"+e+"', '"+d+"' , '"+spd+"','"+c+"',  '"+g+"',   '"+f+"' ,   '"+i+"',  '"+h+"'   , '"+j+"',  '"+b+"', '0',    '"+user+"', '"+update+"',     '"+k+"', '',       '',           '',           '',          '',          '"+f1+"',        '',          '',         '',        '',        '',        '',        '',        '',      '',      ''  ,'"+aspm+"','DAU')";           
            
			if (a ==''){
			swal({
			  title: 'NO SPP KOSONG HARAP DI ISI..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();
			 }
			 
			 
			 
			 if(xx!=4){
				swal({
			  title: 'NOMOR HARUS 4 DIGIT..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			}); 
			exit();
				 	 
				 }
				 
				 	 if(xy!=4){
				swal({
			  title: 'NOMOR HARUS 4 DIGIT..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			}); 
						exit();
				 	 
				 }
				 
			 	if (d ==''){
			swal({
			  title: 'KEBUTUHAN BULAN KOSONG HARAP DI ISI..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();
			 }
			 
			     
			if (aspm ==''){
			swal({
			  title: 'NO SPM KOSONG HARAP DI ISI..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();
			 }
			
			
				if (c ==''){
			swal({
			  title: 'JENIS BEBAN KOSONG HARAP DI ISI..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();
			 }
			 
			 

			 if (e ==''){
			swal({
			  title: 'KEPERLUAN KOSONG HARAP DI ISI..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();
			 }

 if (k ==0){
				swal({
			  title: 'NILAI TIDAK BOLEH KOSONG..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();
			 }
			
			if (k > spd1){
				
				
			swal({
			  title: 'Nilai UP='+k+'Nilai Melebihi SPD UP='+spd1,
			  text: "Auto close alert 2 second",
			  type: "error",
			  timer: 3000,
			  showConfirmButton: false
			});
	
				exit();
			} else {
            
            $(document).ready(function(){
                $.ajax({
                    type     : "POST",
                    url      : '<?php echo base_url(); ?>/index.php/tukd/simpan_tukd',
                    data     : ({tabel:'trhspp',kolom:lcinsert,nilai:lcvalues,cid:'no_spp',lcid:a}),
                    dataType : "json",
                    success  : function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        } else if(status=='1'){
                                  //alert('Nomor SPP Sudah Terpakai...!!!,  Ganti Nomor SPP...!!!');
								  
								  swal({
			  title:'Nomor SPP Sudah Terpakai...!!!,  Ganti Nomor SPP...!!!',
			  text: "Auto close alert 2 second",
			  type: "error",
			  timer: 3000,
			  showConfirmButton: false
			});
                                  exit();
                               } else {
                                  dsimpan_up();
                simpan_spm();
		
					
                    
                                  lcstatus = 'edit';
                                  exit();
                               }
                    }
                });
            }); 
            }  
           
        } else {
            
            lcquery = " UPDATE trhspp SET bulan='"+d+"',kd_skpd='"+kode+"', keperluan='"+e+"',no_spd='"+spd+"', jns_spp='"+c+"', bank='"+g+"', no_rek='"+i+"', npwp='"+h+"', nm_skpd='"+j+"', tgl_spp='"+b+"', nilai='"+k+"', no_spp='"+a+"',username='"+user+"',last_update='"+update+"',nmrekan='"+f+"',pimpinan='"+f1+"',SUMBER='DAU' where no_spp='"+a_hide+"' "; 
            if (k > spd1){
							alert('Nilai SPP='+k+'Melebihi SPD='+spd1);
						} else {            
            $(document).ready(function(){
            $.ajax({
                type     : "POST",
                url      : '<?php echo base_url(); ?>/index.php/tukd/update_tukd',
                data     : ({st_query:lcquery,tabel:'trhspp',cid:'no_spp',lcid:a,lcid_h:a_hide}),
                dataType : "json",
                success  : function(data){
                           status=data ;
                        
                        if ( status=='1' ){
                            alert('Nomor SPP Sudah Terpakai...!!!,  Ganti Nomor SPP...!!!');
                            exit();
                        }
                        
                        if ( status=='2' ){
                            dsimpan_up() ;
        
		        simpan_spm();
		                    lcstatus = 'edit';
                            exit();
                        }
                        
                        if ( status=='0' ){
                            alert('Gagal Simpan...!!!');
                            exit();
                        }
                        
                    }
            });
            });
        }
        }
    }
    
    
    function dsimpan_up() {
        var a         = document.getElementById('no_spp').value ;
		var bb 		  = spd ;
        var rek_up    = $("#rekup").combogrid("getValue") ;
        var nm_rek_up = document.getElementById('nmrekup').value ;
        var nilai_up  = angka(document.getElementById('nilaiup').value) ;

        $(function(){      
         $.ajax({
            type     : 'POST',
            data     : ({cno_spp:a,cskpd:kode,crek:rek_up,nrek:nm_rek_up,nilai:nilai_up,no_spdq:bb}),
            dataType : "json",
            url      : "<?php echo base_url(); ?>index.php/tukd/dsimpan",
            success  : function(data){
            }            
         });
         });
        $("#no_spp_hide").attr("Value",a);
    } 
    
     
    
    
    function dsimpan(kd_rek5,nm_rek5,nilai,kd,no_spdq){
        var a = document.getElementById('no_spp').value;
		var bb = spd ;
        //alert(a);    
        $(function(){      
         $.ajax({
            type: 'POST',
            data: ({cno_spp:a,cskpd:kode,crek:kd_rek5,nrek:nm_rek5,nilai:nilai,kd:kd,no_spdq:bb}),
            dataType:"json",
            url:"<?php echo base_url(); ?>index.php/tukd/dsimpan"            
         });
        });
    } 
    
    
    function detsimpan(){
        var a = document.getElementById('no_spp').value;    
		var bb        = spd ;	
		
        $('#dg1').datagrid('selectAll');
        var rows = $('#dg1').datagrid('getSelections');
         //alert(rows); 
        for(var i=0;i<rows.length;i++){            
            ckdgiat  = rows[i].kdkegiatan;
            cnmgiat  = rows[i].nmkegiatan;
            ckdrek  = rows[i].kdrek5;
            cnmrek  = rows[i].nmrek5;
            cnilai   = rows[i].nilai1;
            cnilai_s   = rows[i].sis;           
            no=i+1;      
            $(document).ready(function(){      
            $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>index.php/tukd/dsimpan" ,
            data: ({cno_spp:a,cskpd:kode,cgiat:ckdgiat,crek:ckdrek,ngiat:cnmgiat,nrek:cnmrek,nilai:cnilai,sis:cnilai_s,kd:no,no_spdq:bb}),
            dataType:"json"            
         });
        });
        }
    } 
    
	
	
	function pengurangan(){
	  var na   = document.getElementById('nilaispd').value;
	    var m    = angka(document.getElementById('nilaiup').value);
        var n    = angka(document.getElementById('nilaispd').value);
				
			if(na==''){
			swal({
			  title: 'PILIH SPD TERLEBIH DAHULU..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();	
		}
		
		
		hasil =n-m;
		if (hasil<0){
			swal({
			 title:"Nilai melebihi spd" ,
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "red",
			  html:true,
			  type: "error",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
			
			$("#nilaiup").attr("value",0);
			
			}
		
		
		
		
	}
			
	
	
    
    
     function hhapus(){				
            
            var spp = document.getElementById("no_spp").value;
			var spm = document.getElementById("no_spm").value;
			//var tag = $('#notagih').combogrid('getValue');
			// var spp = document.getElementById("nomor").value;
			  
            var urll= '<?php echo base_url(); ?>/index.php/tukd/hhapus';         	
			swal({
		  title:"<a style='font-size:large;'>No SPP  dan No SPM </a> <a style='color:red;font-size:large;'>"+spp+" dan "+spm+"</a> <a style='font-size:large;'>?</a>" ,
		  text:"Apakah anda yakin akan Menghapus nospp ??",
		  type: "warning",
		  html:true,
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Ya",
		  cancelButtonText: "Tidak",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
			function(isConfirm){
			if (isConfirm) {
					$(document).ready(function(){
                   // $.post(urll,({no:spp}),
				    $.post(urll,({no:spp}),
						function(data){
							status = data; 
							if (data = 1){
								hhapus_pot();
						//swal("Deleted!", "Data Terhapus", "success");
						
							}
						
						});
                    });				
				}
				});
		}
        
             function hhapus_pot(){				
             var spp = document.getElementById("no_spp").value;
          var spm = document.getElementById("no_spm").value;
		var urll= '<?php echo base_url(); ?>/index.php/tukd/hapus_spm';   

					$(document).ready(function(){
					$.post(urll,({no:spm,spp:spp}),
						function(data){
							status = data; 
							if (data = 1){
						swal("Deleted!", "Data Terhapus", "success");
						section4();
							}
						
						});
                    });				
			
		}
		    
   
   function getSelections(idx){
			var ids = [];
			var rows = $('#dg1').edatagrid('getSelections');
			for(var i=0;i<rows.length;i++){
				ids.push(rows[i].kdkegiatan);
			}
			return ids.join(':');
   }
        
   function getSelections1(idx){
			//alert(idx);
			var ids = [];
			var rows = $('#dg1').edatagrid('getSelections');
			for(var i=0;i<rows.length;i++){
				ids.push(rows[i].kdrek5);
			}
			return ids.join(':');
	}
    
    
    function kembali(){
        $('#kem').click();
    }                
    
     function load_sum_spp(){                
		var spp = document.getElementById('no_spp').value;
        var nospp =spp.split("/").join("123456789");       
        $(function(){      
         $.ajax({
            type: 'POST',
            data:({spp:nospp}),
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_spp",
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#rektotal").attr("value",n['rektotal']);
                    $("#rektotal1").attr("value",n['rektotal1']);
                });
            }
         });
        });
    }
    function tombol(st){  
    if (st=='1'){
    $('#save').linkbutton('disable');
    $('#del').linkbutton('disable');
    $('#sav').linkbutton('disable');
    $('#dele').linkbutton('disable');    
    document.getElementById("p1").innerHTML="Sudah di Buat SPM!!";
     } else {
     $('#save').linkbutton('enable');
     $('#del').linkbutton('enable');
     $('#sav').linkbutton('enable');
     $('#dele').linkbutton('enable');
    document.getElementById("p1").innerHTML="";
     }
    }	
    
        
    function openWindow( url )
        {
			//alert(m+''+aspp+'  '+c);
			var m       = document.getElementById('dn').value;
			var aspp     = document.getElementById('no_spp').value;
			 var c= document.getElementById("jns_beban").value;
			 
			 
        var pptk="";
		
        var no =aspp.split("/").join("123456789");
		var ttd1=$('#ttd').combogrid('getValue');
		var ttd =ttd1.split(" ").join("dd");
		var hal=document.getElementById('hal').value;
		lc= '?cno='+no+'&cttd='+ttd+'&ckode='+m+'&cjns='+c+'&cpptk='+pptk+'&chal='+hal;
	       window.open(url+lc, '_blank');
        window.focus();
        }
        
		
//spmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm


  function cetakspm(){
 var aspm      = document.getElementById('no_spm').value;
 var c=document.getElementById("jns_beban").value;
 
    	var no =aspm.split("/").join("123456789");
		var url ='<?php echo site_url(); ?>/tukd/cetak_spm';
        window.open(url+'/'+no+'/'+c, '_blank');
        window.focus();
       // $("#dialog-modal").dialog('open');
    } 		
		
		
		
		
		
		
   function simpan_spm(){        

        var aspm      = document.getElementById('no_spm').value;
        var a       = document.getElementById('no_spp').value;
		var b       = $('#dd').datebox('getValue');      
        var c       = document.getElementById('jns_beban').value; 
        var d       = document.getElementById('kebutuhan_bulan').value;
        var e       = document.getElementById('ketentuan').value;
        var f       = document.getElementById('rekanan').value;
        var f1      = document.getElementById('dir').value;
        var g       = document.getElementById('bank1').value;
        var h       = document.getElementById('npwp').value;
        var i       = document.getElementById('rekening').value;
        var j       = document.getElementById('nmskpd').value;
        var k       = document.getElementById('nilaiup').value;
		 var m       = document.getElementById('dn').value;
      
		//alert("asdasds");
		k=angka(k);
		
		var user    = '<?php echo $this->session->userdata('pcNama'); ?>';
		var update  = '<?php echo date('Y-m-d H:m:s'); ?>';
		
		var rkanan=f1+','+f;
		
		
		
		if(aspm == ''){
			//alert('ISI DULU NO SPM ...!!!');
			swal({
			  title: 'ISI DULU NO SPM..!!',
			  text: "Auto close alert 2 second",
			  type: "warning",
			  timer: 1000,
			  showConfirmButton: false
			});
				exit();

		}
       
		
		
        if (lcstatus=='tambah') { 

            lcinsert = " ( no_spm,     tgl_spm,   no_spp, kd_skpd,  nm_skpd,  tgl_spp,  bulan,   no_spd,  keperluan, username, last_update, status, jns_spp,  bank,     nmrekan,  no_rek,   npwp,    nilai   ) ";
            lcvalues = " ( '"+aspm+"',   '"+b+"',  '"+a+"', '"+m+"',  '"+j+"',  '"+b+"',  '"+d+"', '"+spd+"', '"+e+"','"+user+"','"+update+"','0',  '"+c+"',  '"+g+"',  '"+rkanan+"',  '"+i+"',  '"+h+"', '"+k+"' ) ";           
            
            $(document).ready(function(){
                $.ajax({
                    type     : "POST",
                    url      : '<?php echo base_url(); ?>/index.php/tukd/simpan_tukd',
                    data     : ({tabel:'trhspm',kolom:lcinsert,nilai:lcvalues,cid:'no_spm',lcid:aspm,tagih:a}),
                    dataType : "json",
                    success  : function(data){
                        status = data;
                        if (status=='0'){
                            //alert('Gagal Simpan..!!');
                            swal({
title:"<a style='font-size:large;'>No SPM </a> <a style='color:red;font-size:large;'>"+aspm+"</a> <a style='font-size:large;'>GAGAL SIMPAN</a>" ,
text:"GAGAL SIMPAN...!!!",
type: "error",
html:true,
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Ya",
closeOnConfirm: true,
});
							
							exit();
                        } else if(status=='1'){
                                  //alert('Nomor SPM Sudah Terpakai...!!!,  Ganti Nomor SPM...!!!');
swal({
title:"<a style='font-size:large;'>No SPM </a> <a style='color:red;font-size:large;'>"+aspm+"</a> <a style='font-size:large;'>Sudah Terpakai</a>" ,
text:"Ganti Nomor SPM...!!!",
type: "error",
html:true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Ya",
closeOnConfirm: true,
});
			$("#no_spm").attr("disabled",false);

                                  exit();
                               } else {
                                  //alert('Data Tersimpan..!!');
								  swal({
			  title: 'Tersimpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
                                  lcstatus = 'edit';
								  //$('#spm').edatagrid('reload');
								  //section1();
                                  exit();
                               }
                    }
                });
            });   
           
        } else {
            
            lcquery = " UPDATE trhspm SET  tgl_spm='"+b+"',  no_spp='"+a+"', kd_skpd='"+m+"',  nm_skpd='"+j+"', tgl_spp='"+b+"',  bulan='"+d+"',   no_spd='"+spd+"',  keperluan='"+e+"',  username='"+user+"',  last_update='"+update+"', jns_spp='"+c+"',  bank='"+g+"',  nmrekan='"+rkanan+"',  no_rek='"+i+"',  npwp='"+h+"',  nilai='"+k+"' where no_spm='"+aspm+"'  "; 
            
            $(document).ready(function(){
            $.ajax({
                type     : "POST",
                url      : '<?php echo base_url(); ?>/index.php/tukd/update_tukd',
                data     : ({st_query:lcquery,tabel:'trhspm',cid:'no_spm',lcid:aspm,lcid_h:aspm}),
                dataType : "json",
                success  : function(data){
                           status=data ;
                        
                        if ( status=='1' ){
                            //alert('Nomor SPM Sudah Terpakai...!!!,  Ganti Nomor SPM...!!!');
							swal({
title:"<a style='font-size:large;'>No SPM </a> <a style='color:red;font-size:large;'>"+a1+"</a> <a style='font-size:large;'>Sudah Terpakai</a>" ,
text:"Ganti Nomor SPM...!!!",
type: "error",
html:true,
showCancelButton: false,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Ya",
closeOnConfirm: true,
});
                            exit();
                        }
                        
                        if ( status=='2' ){
                            //alert('Data Tersimpan...!!!');
							  swal({
			  title: 'Tersimpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
                            lcstatus = 'edit';
                            exit();
                        }
                        
                        if ( status=='0' ){
    //                        alert('Gagal Simpan...!!!');
	                            swal({
title:"<a style='font-size:large;'>No SPM </a> <a style='color:red;font-size:large;'>"+aspm+"</a> <a style='font-size:large;'>GAGAL SIMPAN</a>" ,
text:"GAGAL SIMPAN...!!!",
type: "error",
html:true,
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Ya",
closeOnConfirm: true,
});
                            exit();
                        }
                    }
            });
            });
            }
            $("#no_spm_hide").attr("Value",a1);
        }

function gabung()
{
var a = document.getElementById('satu').value;
var b = document.getElementById('dua').value;
var c = document.getElementById('tiga').value;
var d = document.getElementById('empat').value;

gabung1=a+""+b;
gabung2=c+""+d;

$("#no_spp").attr("value",gabung1);
$("#no_spm").attr("value",gabung2);
}
		
			function ambil_nomor(){
		
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>/index.php/tukd/nobaru',
			data: ({ckode:kode}),
			dataType:"json",
				success: function(data){
					a="/SPP/UP/"+data.bukti+"/"+"DAU/"+data.thn;
					b="/SPM/UP/"+data.bukti+"/"+"DAU/"+data.thn;
					
				$("#dua").attr("value",a);
				$("#empat").attr("value",b);
				
			}
		});
	}

		 function isNumberKeyTrue(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 65)
            return false;        
         return true;
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
<h3><a href="#" id="section4" onclick="javascript:$('#spp').edatagrid('reload')">List SPP</a></h3>
    <div>
    <p align="right">  
     <input style="background-color:#FFFF00;width:20px;border:solid 1px #000000;" disabled/>
    <b>#Sudah di Buat SP2D</b>&nbsp;
			<input style="background-color:#FFF;width:20px;border:solid 1px #000000;" disabled/>
			<b>#Belum di Buat SP2D </b>         
        <a id="tambah" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:section1();kosong();">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="spp" title="List SPP" style="width:870px;height:450px;" >  
        </table>
    </p> 
    </div>

<h3><a href="#" id="section1">Input SPP</a></h3>
   <div  style="height: 550px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>

<fieldset style="width:850px;height:550px;border-color:white;border-style:hidden;border-spacing:0;padding:0;">            

<table border='1' style="font-size:11px" >


 <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">   
   <td width="8%" style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" >&nbsp;</td>
   <td style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>
   <td style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>
   <td style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>   
 </tr>


 
 <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">   
   <td width="8%" style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" >No SPP</td>
   <td style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"> 
  
  
  <input id="satu"  style="width: 50px;" maxlength="4"  onkeypress="return isNumberKeyTrue(event)" onkeyup="gabung();"/>  
  <input type="text" id="dua" style="width: 200px;" onclick="javascript:select();"  disabled="disabled" readonly/>
  <input type="text" name="no_spp" id="no_spp" onclick="javascript:select();" style="width:200px;" hidden/><input type="hidden" name="no_spp_hide" id="no_spp_hide" onclick="javascript:select();" style="width:200px;" hidden="true"/></td>
  
   <td style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">Tanggal</td>
   <td style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;<input id="dd" name="dd" type="text" /></td>   
 </tr>
   <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >No SPM</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
   
   <input id="tiga"  style="width: 50px;" maxlength="4"   onkeypress="return isNumberKeyTrue(event)" onkeyup="gabung();" />  
  <input type="text" id="empat" style="width: 200px;" onclick="javascript:select();"  disabled="disabled" readonly/>

   
   <input type="text" name="no_spm" id="no_spm" onclick="javascript:select();"  style="width:200px;" hidden/><input type="hidden" name="no_spm_hide" id="no_spm_hide" onclick="javascript:select();"  style="width:200px;" hidden/></td>
  <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bulan</td>
   <td width="31%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><select  name="kebutuhan_bulan" id="kebutuhan_bulan" >
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
 <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">
   <td width='8%' style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">SKPD</td>
   <td width="53%" style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" >     
      <input id="dn" name="dn" readonly="true" style="width:200px; border: 0; " /></td> 
   <td width='8%' style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">Beban</td>
   <td width="31%" style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" ><select name="jns_beban" id="jns_beban">
     <option value="1">UP</option>
   </select></td>
 </tr>
 
 <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">
   <td width='8%'  style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>
   <td width='53%' style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"><textarea name="nmskpd" id="nmskpd" cols="40" rows="1" style="border: 0;"  readonly="true"></textarea></td>
   <td width='8%'  style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">Keperluan</td>
   <td width='31%' style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"><textarea name="ketentuan" id="ketentuan" cols="30" rows="2" ></textarea></td>
 </tr>
 
 <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">
   <td width='8%' style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">No SPD</td>
   <td style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"><input id="sp" name="sp" style="width:200px" /></td>
   <td style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" width='8%'>Bank</td>
   <td style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"><?php
								  		$bank1="select * from ms_bank ";
                                        $pagingquery1 = $bank1; //echo "edit  $pagingquery1<br />";
                                        $res = mysql_query($pagingquery1)or die("pagingquery gagal".mysql_error());
								?>
     <select name="bank1" id="bank1" style="height: 27px; width: 200px;">
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
 
  <tr>
  <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekanan/Dir.</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="rekanan" name="rekanan" style="width:190px" value="" class='alfi'/>
  
   <input id="dir" name="dir" style="width:190px"/></td>
 </tr>
 
 
 
 <tr style="border-spacing:0px;padding:0px 0px 0px 0px;border-collapse:collapse;">
   <td style="border-bottom-style:hidden;border-right-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" width='8%'>NPWP</td>
   <td style="border-bottom-style:hidden;border-right-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" width='53%'><input type="text" name="npwp" id="npwp" value="" style="width:200px;" /></td>
   <td style="border-bottom-style:hidden;border-right-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" width='8%'>Rekening</td>
   <td style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" width='31%'>&nbsp;<input type="text" name="rekening" id="rekening"  value="" style="width:200px;" /></td>
 </tr>

 <tr style="border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">   
   <td width="8%" style="border-right-style:hidden;border-bottom-color:black;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;" >&nbsp;</td>
   <td style="border-right-style:hidden;border-bottom-color:black;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>
   <td style="border-right-style:hidden;border-bottom-color:black;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>
   <td style="border-bottom-color:black;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">&nbsp;</td>   
 </tr> 
</table>
        
        
        <table border='1'>
        
            <tr style="border-bottom-style:hidden;border-spacing:0px;padding:0px 0px 0px 0px;border-collapse:collapse;">
                 <td colspan='3' style="font-size:20px;font:bold;color:#004080;" >DETAIL SPP UP</td>
            </tr>
            
            <tr>
                 <td colspan='3' style="border-bottom-style:hidden;">&nbsp;</td>
            </tr>

        
            <tr style="border-spacing:0px;padding:0px 0px 0px 0px;border-collapse:collapse;border-bottom-style:hidden;">
                 <td width='10%' style="border-right-style:hidden;border-bottom-style:hidden;">Rekening</td>
                 <td width='15%' style="border-right-style:hidden;border-bottom-style:hidden;"><input type="text" name="rekup" id="rekup" value="" style="width:200px;" /></td>
                 <td width='75%' style="border-bottom-style:hidden;"><input type="text" name="nmrekup" id="nmrekup" value="" style="width:500px;border:0" readonly="true" /></td>
            </tr>
            
            <tr style="border-spacing:0px;padding:0px 0px 0px 0px;border-collapse:collapse;">
                 <td width='10'  style="border-bottom-style:hidden;border-right-style:hidden;">Nilai</td>
                 <td width='15%' style="border-bottom-style:hidden;border-bottom-color:black;border-right-style:hidden;"><input type="text" name="nilaiup" id="nilaiup"  value="" style="width:200px;text-align:right;"  onkeyup="javascript:pengurangan();"/> </td>
                 <td width='75'  style="border-bottom-style:hidden;">&nbsp;</td>
            </tr>
            <tr style="border-spacing:0px;padding:0px 0px 0px 0px;border-collapse:collapse;">
                 <td width='10'  style="border-bottom-style:hidden;border-right-style:hidden;">Nilai SPD</td>
                 <td width='15%' style="border-bottom-style:hidden;border-bottom-color:black;border-right-style:hidden;"><input type="text" name="nilaispd" id="nilaispd"  readonly="true" value="" style="width:200px;text-align:right; background:#FCA4AD"/> </td>
                 <td width='75'  style="border-bottom-style:hidden;">&nbsp;</td>
            </tr>            
            <tr>
                 <td colspan='3' style="border-bottom-color:black;">&nbsp;</td>
            </tr>
            
        </table>
        
        
        <table align="center">
            <tr style="border-bottom-style:hidden;border-spacing:0px;padding:0px 0px 0px 0px;border-collapse:collapse;">
                <td align="center">
                  <div>
                        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Baru</a>
                        <a id="save" class="easyui-linkbutton" iconCls="icon-save" plain="false"  onclick="javascript:$('#dg1').edatagrid('addRow');javascript:$('#dg1').edatagrid('reload');javascript:ceknospmspp();">Simpan</a>
                        <a id="del"class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hhapus();">Hapus</a>
                        <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section4();">Kembali</a>
                        <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetak();">cetak SPP</a>
                                            <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetakspm();">cetak SPM</a>
                  </div>
                </td>                
            </tr>
        </table>
        
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            

   </p>
   </fieldset> 
   </div>

</div>
</div> 

<div id="dialog-modal" title="CETAK SPP">
    
    <p class="validateTips">SILAHKAN PILIH SPP</p>  
    
    <fieldset>
    <table>
        <tr>            
            <td width="110px">NO SPP:</td>
            <td><input id="cspp" name="cspp" style="width: 170px;" /></td>
        </tr>
        <tr>
            <td width="110px">Penandatangan:</td>
            <td><input id="ttd" name="ttd" style="width: 170px;" /></td>
        </tr>
		<tr>
			 <td width="110px">Enter TTD</td>
			 <td><input id="hal" name="hal" style="width: 20px;" />&nbsp;baris</td>
		</tr>
    </table>  
    </fieldset>
    <div>
    
    </div>     
    <a href="<?php echo site_url(); ?>/tukd/cetakspp1/" class="easyui-linkbutton" plain="false" onclick="javascript:openWindow(this.href);return false;">SPP1</a>
    <a href="<?php echo site_url(); ?>/tukd/cetakspp2/" class="easyui-linkbutton" plain="false" onclick="javascript:openWindow(this.href);return false;">SPP2</a>
    <a href="<?php echo site_url(); ?>/tukd/cetakspp3/" class="easyui-linkbutton" plain="false" onclick="javascript:openWindow(this.href);return false;">SPP3</a>
	<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>  
</div>
 	
</body>

</html>
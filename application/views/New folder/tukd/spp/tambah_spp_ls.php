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
    <style>    
    #tagih {
        position: relative;
        width: 700px;
        height: 70px;
        padding: 0.4em;
    }  
    </style>
    
    <script type="text/javascript"> 
   
    var nl       = 0;
	var tnl      = 0;
	var idx      = 0;
	var tidx     = 0;
	var oldRek   = 0;
    var rek      = 0;
    var kode     = '';
    var pidx     = 0;  
    var frek     = '';             
    var rek5     = '';
    var edit     = '';
    var lcstatus = '';
	var hal='';
                    
    $(document).ready(function() {
            $("#accordion").accordion({
            height: 500
            });
            $("#lockscreen").hide();                        
            $("#frm").hide();
            $( "#dialog-modal" ).dialog({
            height: 200,
            width: 380,
            modal: true,
            autoOpen:false
        });
        $( "#dialog-modal-rek" ).dialog({
            height: 320,
            width: 900,
            modal: true,
            autoOpen:false
        });
            $("#tagih").hide();
            get_skpd();
			$('#hal').attr("value",0);
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
                
                
                $('#cspp').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/load_spp2',  
                    idField:'no_spp',                    
                    textField:'no_spp',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                        {field:'no_spp',title:'SPP',width:60},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:60},
                        {field:'tgl_spp',title:'Tanggal',width:60} 
                    ]],
                    onSelect:function(rowIndex,rowData){
                    nomer = rowData.no_spp;
                    kodej = rowData.kd_skpd;
                    jns = rowData.jns_spp;
                    //val_ttd(kodej);
                    }   
                });
                
                
                $('#notagih').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/load_no_penagihan',  
                    idField:'no_tagih',  
                    textField:'no_tagih',
                    mode:'remote',  
                    fitColumns:true,  
                    columns:[[  
                           {field:'no_tagih',title:'No Penagihan',width:140},  
                           {field:'tgl_tagih',title:'Tanggal',width:140},
                           {field:'kd_skpd',title:'SKPD',width:140}
                       ]],  
                    onSelect:function(rowIndex,rowData){
                    var ststagih='1';
                    $("#tgltagih").attr("value",rowData.tgl_tagih);
                    $("#nil").attr("value",rowData.nila);
                    $("#ni").attr("value",rowData.nil);
                    }   
                });
                    
                    
                    $('#spp').edatagrid({
            		url: '<?php echo base_url(); ?>/index.php/tukd/load_spp',
                    idField:'id',            
                    rownumbers:"true", 
                    fitColumns:"true",
                    singleSelect:"true",
                    autoRowHeight:"false",
                    loadMsg:"Tunggu Sebentar....!!",
                    pagination:"true",
                    nowrap:"true",                       
                    columns:[[
                	    {field:'no_spp',
                		title:'Nomor SPP',
                		width:40},
                        {field:'tgl_spp',
                		title:'Tanggal',
                		width:25},
                        {field:'kd_skpd',
                		title:'Nama SKPD',
                		width:25,
                        align:"left"},
                        {field:'keperluan',
                		title:'Keterangan',
                		width:140,
                        align:"left"}
                    ]],
                    onSelect:function(rowIndex,rowData){
                      no_spp   = rowData.no_spp;         
                      kode     = rowData.kd_skpd;
                      sp       = rowData.no_spd;          
                      bl       = rowData.bulan;
                      tg       = rowData.tgl_spp;
                      jn       = rowData.jns_spp;
                      kep      = rowData.keperluan;
                      np       = rowData.npwp;
                      rekan    = rowData.nmrekan;
                      bk       = rowData.bank;
                      ning     = rowData.no_rek;
                      status   = rowData.status;
                      kegi     = rowData.kd_kegiatan;
                      nm       = rowData.nm_kegiatan;
                      kprog    = rowData.kd_program;
                      nprog    = rowData.nm_program;
                      dir      = rowData.dir;
                      notagih  = rowData.no_tagih;
                      tgltagih = rowData.tgl_tagih;
                      sttagih  = rowData.sts_tagih;     
					  $('#hal').attr("value",0);
                      get(no_spp,kode,sp,tg,bl,jn,kep,np,rekan,bk,ning,status,kegi,nm,kprog,nprog,dir,notagih,tgltagih,sttagih);
                      det();       
                      detail_trans_3();   
                      validate_kegiatan() ;
                      load_sum_spp(); 
                      edit = 'T' ;
                      lcstatus = 'edit';
                    },
                    onDblClickRow:function(rowIndex,rowData){
                        section2();   
                    }
                });
                
                
                
                $('#sp').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/spd3_ls_ppkd',                
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
                    validate_kegi(spd)
                    
                    nilspd = rowData.total;
          n = rowData.nilai;
          h = rowData.h;
          
          $("#nilaispd").attr("value",h);
                                                                        
                    }    
                });
                
                
                $('#kg').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/kegi',  
                    idField:'kd_kegiatan',  
                    textField:'kd_kegiatan',
                    mode:'remote',  
                    fitColumns:true,                       
                    columns:[[  
                        {field:'kd_kegiatan',title:'Kode',width:30},  
                        {field:'nm_kegiatan',title:'Nama',align:'left',width:70}                          
                    ]],
                    onSelect:function(rowIndex,rowData){
                    kegi   = rowData.kd_kegiatan;
                    nmkegi = rowData.nm_kegiatan;
                    $("#nm_kg").attr("value",rowData.nm_kegiatan);
                    prog = rowData.kd_program;
                    $("#kp").attr("value",rowData.kd_program);
                    nmprog = rowData.nm_program;
                    $("#nm_kp").attr("value",rowData.nm_program);
                    nilai= rowData.nilai;                   
                    det();                                                        
                    }    
                });
                
                
                $('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data2',
                 autoRowHeight:"true",
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 singleSelect:"true",
			});
            
           /*  $('#ttd').combogrid({  
			   panelWidth:500,  
			   idField   :'nip',  
			   textField :'nama',  
			   mode      :'remote',
			   columns   :[[  
				   {field:'nip',title:'NIP',width:60},  
				   {field:'nama',title:'NAMA',align:'left',width:100}           
				 ]]  
			   });  */
			   $('#ttd').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_ttd',  
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

                $('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                 autoRowHeight:"true",
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 singleSelect:"true",
			});
            
            
                $('#dgsppls').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"false",
                 columns:[[
                    {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},               
                    {field:'kdkegiatan',title:'Kegiatan',width:150,align:'left'},
					{field:'kdrek5',title:'Rekening',width:70,align:'left'},
					{field:'nmrek5',title:'Nama Rekening',width:280},
                    {field:'nilai1',title:'Nilai',width:140,align:'right'},
                    {field:'hapus',title:'Hapus',width:100,align:"center",
                    formatter:function(value,rec){ 
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                    }
                    }
				]]	
           }); 
            
           
           $('#rek_skpd').combogrid({  
           panelWidth:700,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/skpd_2',  
           columns:[[  
               {field:'kd_skpd',title:'Kode SKPD',width:100},  
               {field:'nm_skpd',title:'Nama SKPD',width:700}    
           ]],  
           onSelect:function(rowIndex,rowData){
               kode = rowData.kd_skpd ;               
               $("#rek_nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
           }  
           });
           
           
           $('#rek_kegi').combogrid({  
           panelWidth:700,  
           idField:'kd_kegiatan',  
           textField:'kd_kegiatan',  
           mode:'remote',
           columns:[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:150},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:700}    
           ]]  
           });
           
           
           $('#rek_reke').combogrid({  
           panelWidth:700,  
           idField   :'kd_rek5',  
           textField :'kd_rek5',  
           mode      :'remote',
           columns   :[[  
               {field:'kd_rek5',title:'Kode Rekening',width:150},  
               {field:'nm_rek5',title:'Nama Rekening',width:700}    
           ]]  
           });

        });
        
        
        function get_skpd()
        {
        	$.ajax({
        		url:'<?php echo base_url(); ?>index.php/tukd/config_skpd',
        		type: "POST",
        		dataType:"json",                         
        		success:function(data){
  								      $("#dn").attr("value",data.kd_skpd);
        							  $("#nmskpd").attr("value",data.nm_skpd);
                                      $("#rek_skpd").combogrid("setValue",data.kd_skpd);
									  $("#rekening").attr("value",data.rekening);
									  $("#rekanan").attr("Value",data.nama);
									  $("#npwp").attr("Value",data.npwp);
									  $("#dir").attr("Value",data.nip);
                                      $("#rek_nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
                                      kode = data.kd_skpd;
                                      validate_spd(kode);
        	}  
            });
        }
        
        
        function validate_kegiatan(){
            
            var kode_s = document.getElementById('dn').value;
            $(function(){
              $('#rek_kegi').combogrid({  
              panelWidth:700,  
              idField   :'kd_kegiatan',  
              textField :'kd_kegiatan',  
              mode      :'remote',
              url       :'<?php echo base_url(); ?>index.php/tukd/load_trskpd_ar_2',  
              queryParams:({kdskpd:kode_s}), 
              columns   :[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:150},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:700}    
               ]],
               onSelect:function(rowIndex,rowData){      
               $("#nm_rek_kegi").attr("value",rowData.nm_kegiatan); 
               $("#rek_reke").combogrid("setValue",''); 
               validate_rekening(); 
               }              
           });
           });
        }    
        
 
        function validate_rekening(){
           //alert(kode);
           $('#dgsppls').datagrid('selectAll');
           var rows = $('#dgsppls').datagrid('getSelections');     
           frek  = '' ;
           rek5  = '' ;
           for ( var p=0; p < rows.length; p++ ) { 
           rek5 = rows[p].kdrek5;                                       
           if ( p > 0 ){   
                  frek = frek+','+rek5;
              } else {
                  frek = rek5;
              }
           }
         
                
                var kode_s   = document.getElementById('dn').value  ;
                
                var kode_keg = $('#rek_kegi').combogrid('getValue') ;
                var nospp    = document.getElementById('no_spp').value ;
                
                $(function(){
                  $('#rek_reke').combogrid({  
                  panelWidth:700,  
                  idField   :'kd_rek5',  
                  textField :'kd_rek5',  
                  mode      :'remote',
                  url       :'<?php echo base_url(); ?>index.php/tukd/load_rek_ar',  
                  queryParams:({kdkegiatan:kode_keg,kdrek:frek}), 
                  columns:[[  
                   {field:'kd_rek5',title:'Kode Rekening',width:150},  
                   {field:'nm_rek5',title:'Nama Rekening',width:700}    
                   ]],
                   onSelect:function(rowIndex,rowData){      
                   
                           $("#nm_rek_reke").attr("value",rowData.nm_rek5); 
                           var koderek = rowData.kd_rek5 ;
                            //alert(kode_keg+"/"+koderek+"/"+kode_s+"/"+nospp);
                           $.ajax({
                                type     : "POST",
                        		dataType : "json",   
                                data     : ({kegiatan:kode_keg,kdrek5:koderek,kd_skpd:kode_s,no_spp:nospp}), 
                        		url      : '<?php echo base_url(); ?>index.php/tukd/jumlah_ang_spp',
                        		success  : function(data){
                        		      $.each(data, function(i,n){
                                        $("#rek_nilai_ang").attr("Value",n['nilai']);
                                        $("#rek_nilai_spp").attr("Value",n['nilai_spp_lalu']);
                                        
                                        var n_ang  = n['nilai'] ;
                                        var n_spp  = n['nilai_spp_lalu'] ;
                                        var n_sisa = angka(n_ang) - angka(n_spp) ;
                                        $("#rek_nilai_sisa").attr("Value",number_format(n_sisa,2,'.',','));
                                    });
        						}                                     
        	               });
                   }                
               });
               });
               $('#dgsppls').datagrid('unselectAll');
        }
           
        
        
        function val_ttd(dns){
           $(function(){
            $('#ttd').combogrid({  
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
    
    
    function validate_kegi(spd){
           $(function(){
            $('#kg').combogrid({  
                panelWidth:500,                          
                url: '<?php echo base_url(); ?>/index.php/tukd/kegi',
                 queryParams:({spd:spd}),  
                    idField:'kd_kegiatan',  
                    textField:'kd_kegiatan',
                    mode:'remote',  
                    fitColumns:true
                });
           });
        }

   
    function det(){   
          $(function(){            
			$('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data2',
                queryParams:({giat:kegi}),
                 idField:'id',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,
                 onLoadSuccess:function(data){
                      detail1();                                           
                    },                      
                 onClickRow:function(rowIndex, rowData){                                
								keg=rowData.kd_kegiatan;
								rk=rowData.kd_rek5;
                                nkeg=rowData.nm_kegiatan;
                                nrek=rowData.nm_rek5;
                                ang=rowData.a;
                                kel=rowData.b;
                                sisa=ang - kel;
								simpan(keg,rk,nkeg,nrek,sisa);
                                detail1();
							 },				 				 
                 columns:[[
	                {field:'ck',
					 title:'ck',
					 checkbox:true,
					 hidden:true},
                     {field:'pilih',
					 title:'pilih',
					 width:20,
                     align:'center',
					 checkbox:true,
                     hidden:true
                     },
                     {field:'kd_kegiatan',
					 title:'Kegiatan',
					 width:150,
					 align:'left'
					},                    
					{field:'kd_rek5',
					 title:'Rekening',
					 width:70,
					 align:'left'
					},
					{field:'nm_rek5',
					 title:'Nama Rekening',
					 width:300
					},
                    {field:'a',
					 title:'Nilai Anggaran',
					 width:100,
                     align:'right',
                      hidden:true
                     },
                    {field:'b',
					 title:'SPP Lalu',
					 width:100,
                     align:'right',
                     hidden:true
                     },
                    {field:'nilai',
					 title:'Nilai Anggaran',
					 width:100,
                     align:'right'
                     },
                    {field:'total',
					 title:'SPP Lalu',
					 width:100,
                     align:'right'
                     }
				]]	
			});
            });
        }

        
        function det_baru(){   
	   	  var kegi='';
          $(function(){            
			$('#dg').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data2',
                queryParams:({giat:kegi}),
                 idField:'id',
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
                     {field:'pilih',
					 title:'pilih',
					 width:20,
                     align:'center',
					 checkbox:true,
                     hidden:true
                     },
                     {field:'kd_kegiatan',
					 title:'Kegiatan',
					 width:150,
					 align:'left'
					},                    
					{field:'kd_rek5',
					 title:'Rekening',
					 width:70,
					 align:'left'
					},
					{field:'nm_rek5',
					 title:'Nama Rekening',
					 width:300
					},
                    {field:'a',
					 title:'Nilai Anggaran',
					 width:100,
                     align:'right'
                     },
                    {field:'b',
					 title:'SPP Lalu',
					 width:100,
                     align:'right'
                     }
				]]	
			});
            });
        }


        function detail1(){
        $(function(){
	   	    var spp = document.getElementById('no_spp').value;            
			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams:({spp:spp}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,
                 onLoadSuccess:function(data){                      
                      //load_sum_spp();                        
                    },
                onSelect:function(rowIndex,rowData){
                kd = rowIndex;                                               
                },   
                 onAfterEdit:function(rowIndex, rowData, changes){								
								kegiatan=rowData.kdkegiatan;
                                nkegiatan=rowData.nmkegiatan;
								rekeing=rowData.kdrek5;
                                nrekeing=rowData.nmrek5;
                                nilai=rowData.nilai1;
                                si=rowData.sis;
                                kd=rowIndex;
								dsimpan(kegiatan,rekeing,nkegiatan,nrekeing,nilai,si,kd);       	                                  
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
                     align:'right',                    
					 editor:{type:"numberbox"					     
							}
                     }
				]]	
			});
		});
        }


     function get(no_spp,kd_skpd,no_spd,tgl_spp,bulan,jns_spp,keperluan,npwp,rekanan,bank,rekening,status,giat,nmgiat,prog,nmprog,pim,notagih,tgltagih,ststagih){
        $("#no_spp").attr("value",no_spp);
        $("#no_spp_hide").attr("value",no_spp);
        $("#sp").combogrid("setValue",no_spd);
        $("#dd").datebox("setValue",tgl_spp);
        $("#kebutuhan_bulan").attr("Value",bulan);
        $("#ketentuan").attr("Value",keperluan);
        $("#jns_beban").attr("Value",jns_spp);
        $("#npwp").attr("Value",npwp);
        $("#rekanan").attr("Value",rekanan);
        $("#dir").attr("Value",pim);
        $("#bank1").attr("Value",bank);
        $("#rekening").attr("Value",rekening);
        $("#kg").combogrid("setValue",giat);
        $("#nm_kg").attr("Value",nmgiat);
        $("#kp").attr("setValue",prog);
        $("#nm_kp").attr("Value",nmprog);
        $("#notagih").combogrid("setValue",notagih);        
        $("#tgltagih").attr("Value",tgltagih);    
        $("#status").attr("checked",false);                  
        if (ststagih==1){            
            $("#status").attr("checked",true);
            $("#tagih").show();
        } else {
            $("#status").attr("checked",false);
            $("#tagih").hide();
        }
         tombol(status);           
        }
		
   
    function kosong(){
		cdate = '<?php echo date("Y-m-d"); ?>'; 
        $("#no_spp").attr("value",'');
        $("#no_spp_hide").attr("value",'');
        $("#sp").combogrid("setValue",'');
        $("#dd").datebox("setValue",cdate);
        $("#kebutuhan_bulan").attr("Value",'');
        $("#ketentuan").attr("Value",'');
        $("#jns_beban").attr("Value",'');
        //$("#npwp").attr("Value",'');
        //$("#rekanan").attr("Value",'');
        //$("#dir").attr("Value",'');
        $("#bank1").attr("Value",'');
        //$("#rekening").attr("Value",'');
        $("#kg").combogrid("setValue",'');
        $("#nm_kg").attr("Value",'');
        $("#kg").combogrid("setValue",'');
        $("#nm_kg").attr("Value",'');
        $("#kp").attr("setValue",'');
        $("#nm_kp").attr("Value",'');
        document.getElementById("p1").innerHTML="";        
        $("#sp").combogrid("clear");
        $("#kg").combogrid("clear");
		$('#hal').attr("value",0);
        det_baru();
        tombolnew();
        detail_kosong(); 
        validate_kegiatan();  

        var pidx  = 0   ;     
        edit      = 'F' ;
        $("#nilaispd").attr("value",0);
        $("#rektotal_ls").attr("Value",0);
        $("#rektotal1_ls").attr("Value",0);
        
        lcstatus = 'tambah';
        
        }


	
    function getRowIndex(target){  
			var tr = $(target).closest('tr.datagrid-row');  
			return parseInt(tr.attr('datagrid-row-index'));  
		}  


    
    function simpan(giat,reke,nkeg,nrek,sisa){		
		var spp   = document.getElementById('no_spp').value;
		var cskpd = kode;
        var cspd  = spd;

        $(function(){      
            $.ajax({
            type: 'POST',
            data: ({cskpd:cskpd,cspd:spd,cspp:spp,cgiat:giat,crek:reke,cnmgiat:nkeg,cnmrek:nrek,sspp:sisa}),
            dataType:"json",
            url:'<?php echo base_url(); ?>/index.php/tukd/tsimpan'
         });
        });
		}       
        
       
    function cetak(){
        var nom=document.getElementById("no_spp").value;
        $("#cspp").combogrid("setValue",nom);
        $("#dialog-modal").dialog('open');
    } 
    
    
    function keluar(){
        $("#dialog-modal").dialog('close');
    } 
    
    
    function keluar_rek(){
        $("#dialog-modal-rek").dialog('close');
        $("#dgsppls").datagrid("unselectAll");

        $("#rek_nilai").attr("Value",0);
        $("#rek_nilai_ang").attr("Value",0);
        $("#rek_nilai_spp").attr("Value",0);
        $("#rek_nilai_sisa").attr("Value",0);
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
        
    
    function section1(){
         $(document).ready(function(){    
             $('#section1').click();                                               
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

     
    function hsimpan(){        
        var kode =document.getElementById('dn').value;
        var a       = document.getElementById('no_spp').value;
        var a_hide  = document.getElementById('no_spp_hide').value;
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
        var k       = angka(document.getElementById('rektotal_ls').value);
        var l       = document.getElementById('nm_kg').value;
        var m       = document.getElementById('kp').value;
        var n       = document.getElementById('nm_kp').value;
        var o       = document.getElementById('status').checked; 
        var spd1  = document.getElementById('nilaispd').value;
        var p       = $("#sp").combogrid("getValue") ; 
        var q       = $("#kg").combogrid("getValue") ; 
                
        if ( o == false ){
           o=0;
        }else{
            o=1;
        }
        
        if ( a == '' ){
            alert("Isi Nomor SPP Terlebih Dahulu...!!!") ;
            exit();
        }
        
        if ( b == '' ){
            alert("Isi Tanggal Terlebih Dahulu...!!!") ;
            exit();
        }
        
        if ( c == '' ){
            alert("Isi Jenis Beban Terlebih Dahulu...!!!") ;
            exit();
        }
        
        if ( d == '' ){
            alert("Isi Kebutuhan Bulan Terlebih Dahulu...!!!") ;
            exit();
        }
        
        if ( p == '' ){
            alert("Isi Nomor SPD Terlebih Dahulu...!!!") ;
            exit();
        }
        
        if ( q == '' ){
            alert("Isi Kode Kegiatan Terlebih Dahulu...!!!") ;
            exit();
        }

        var p = $('#notagih').combogrid('getValue');
        var q = document.getElementById('tgltagih').value; 
        
        if (lcstatus=='tambah') { 
            
            //lcinsert = "(no_spp,  kd_skpd,    keperluan, bulan,   no_spd,    jns_spp, bank,    nmrekan,  no_rek,  npwp,    nm_skpd,  tgl_spp, status, username,     last_update,         nilai,    no_bukti,     kd_kegiatan,  nm_kegiatan,  kd_program,  nm_program,  pimpinan,  no_tagih,    tgl_tagih,  sts_tagih, no_bukti2, no_bukti3, no_bukti4, no_bukti5, no_spd2, no_spd3, no_spd4 )"; 
            //lcvalues = "('"+a+"', '"+kode+"', '"+e+"',   '"+d+"', '"+spd+"', '"+c+"', '"+g+"', '"+f+"',  '"+i+"', '"+h+"', '"+j+"',  '"+b+"', '0',    '"+pcNama+"', date('Y-m-d H:i:s'), '"+k+"',  '',           '"+kegi+"',   '"+l+"',      '"+m+"',     '"+n+"',     '"+f1+"',  '"+p+"',     '"+q+"',    '"+o+"',    '',       '',        '',        '',        '',      '',      ''      )";
            
            // kurang nya username dan lastupdate 
            
            lcinsert = "(no_spp,  kd_skpd,    keperluan, bulan,   no_spd,    jns_spp, bank,    nmrekan,  no_rek,  npwp,    nm_skpd,  tgl_spp, status, username,     last_update,   nilai,    no_bukti,     kd_kegiatan,  nm_kegiatan,  kd_program,  nm_program,  pimpinan,  no_tagih,    tgl_tagih,  sts_tagih, no_bukti2, no_bukti3, no_bukti4, no_bukti5, no_spd2, no_spd3, no_spd4 )"; 
            lcvalues = "('"+a+"', '"+kode+"', '"+e+"',   '"+d+"', '"+spd+"', '"+c+"', '"+g+"', '"+f+"',  '"+i+"', '"+h+"', '"+j+"',  '"+b+"', '0',    '',           '',            '"+k+"',  '',           '"+kegi+"',   '"+l+"',      '"+m+"',     '"+n+"',     '"+f1+"',  '"+p+"',     '"+q+"',    '"+o+"',    '',       '',        '',        '',        '',      '',      ''      )";
            //lcupdate = " UPDATE trhtagih SET sts_tagih='1' where no_bukti='"+p+"' "; 
            if (k > spd1){
              alert('Nilai SPP='+k+'Melebihi SPD='+spd1);
            } else {
            $(document).ready(function(){
                $.ajax({
                    type     : "POST",
                    url      : '<?php echo base_url(); ?>/index.php/tukd/simpan_tukd',
                    data     : ({tabel:'trhspp',kolom:lcinsert,nilai:lcvalues,cid:'no_spp',lcid:a,tagih:p}),
                    dataType : "json",
                    success  : function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        } else if(status=='1'){
                                  alert('Data Sudah Ada..!!');
                                  exit();
                               } else {
                                  detsimpan();
                                  alert('Data Tersimpan..!!');
                                  lcstatus = 'edit';
                                  exit();
                               }
                    }
                });
            });   
           }
        } else {
            //alert(k);
            lcquery = " UPDATE trhspp SET kd_skpd='"+kode+"', keperluan='"+e+"', bulan='"+d+"', no_spd='"+spd+"', jns_spp='"+c+"', bank='"+g+"', nmrekan='"+f+"', no_rek='"+i+"', npwp='"+h+"', nm_skpd='"+j+"', tgl_spp='"+b+"', status='0', nilai='"+k+"', kd_kegiatan='"+kegi+"', nm_kegiatan='"+l+"', kd_program='"+m+"', nm_program='"+n+"', pimpinan='"+f1+"', no_tagih='"+p+"', tgl_tagih='"+q+"', sts_tagih='"+o+"', no_spp='"+a+"' where no_spp='"+a_hide+"' "; 
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
                            detsimpan() ;
                            alert('Data Tersimpan...!!!');
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
    
    
    function dsimpan(kegiatan,rekening,nkegiatan,nrekening,nilai,sis,kd){
        var a = document.getElementById('no_spp').value;
		var p       = $("#sp").combogrid("getValue") ; 
        $jak  = eval(sis);
        $son  = eval(nilai);       
        if ($son > $jak){
            alert('nilai melebihi anggaran')
        } else {
        $(function(){      
         $.ajax({
            type     : 'POST',
            data     : ({cno_spp:a,cskpd:kode,cgiat:kegiatan,crek:rekening,ngiat:nkegiatan,nrek:nrekening,nilai:nilai,sis:sis,kd:kd,cp:p}),
            dataType :"json",
            url      :"<?php echo base_url(); ?>index.php/tukd/dsimpan"            
         });
        });
        }
    } 
    
    
    function detsimpan(){

        var a         = document.getElementById('no_spp').value; 
        var kode      = $("#rek_skpd").combogrid("getValue") ;
        var cnmgiat   = document.getElementById('nm_rek_kegi').value;
        var cnobukti1 = '' ;
        var a_hide    = document.getElementById('no_spp_hide').value; 
        var p       = $("#sp").combogrid("getValue") ; 
        $(document).ready(function(){      
           $.ajax({
           type     : 'POST',
           url      : "<?php  echo base_url(); ?>index.php/tukd/dsimpan_hapus",
           data     : ({cno_spp:a_hide,lcid:a,lcid_h:a_hide}),
           dataType : "json",
           success  : function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Hapus Detail Old');
                            exit();
                        } 
                        }
                        });
        });
        
        
        $('#dgsppls').datagrid('selectAll');
        var rows = $('#dgsppls').datagrid('getSelections');
        
        for(var i=0;i<rows.length;i++){            
            cidx      = rows[i].idx;
            ckdgiat   = rows[i].kdkegiatan;
            ckdrek    = rows[i].kdrek5;
            cnmrek    = rows[i].nmrek5;
            cnilai    = angka(rows[i].nilai1);
                       
            no        = i + 1 ;      
            $(document).ready(function(){      
                $.ajax({
                type     : 'POST',
                url      : "<?php  echo base_url(); ?>index.php/tukd/dsimpan",
                data     : ({cno_spp:a,cskpd:kode,cgiat:ckdgiat,crek:ckdrek,ngiat:cnmgiat,nrek:cnmrek,nilai:cnilai,kd:no,no_bukti1:cnobukti1,cp:p}),
                dataType : "json"
                });
            });
        }
        $("#no_spp_hide").attr("Value",a) ;
        $('#dgsppls').edatagrid('unselectAll');
    } 
    
    
    function hapus(){				
                var spp = document.getElementById("no_spp").value;                
                var nospp =spp.split("/").join("123456789");
				var giat=getSelections();
                var rek=getSelections1();
				if (rek !=''){
				var del=confirm('Anda yakin akan menghapus rekening '+rek+' kegiatan'+giat+ ' ?');
				if  (del==true){
					$(function(){
						$('#dg1').edatagrid({
							 url: '<?php echo base_url(); ?>/index.php/tukd/thapus/'+nospp+'/'+giat+'/'+rek,
							 idField:'id',
							 toolbar:"#toolbar",              
							 rownumbers:"true", 
							 fitColumns:"true",
							 singleSelect:"true"
						});
					});
				
				}
				}
		}
          
        
        function hhapus(){				
            
            var spp = document.getElementById("no_spp").value;  
            var urll= '<?php echo base_url(); ?>/index.php/tukd/hhapus';             			    
         	if (spp !=''){
				var del=confirm('Anda yakin akan menghapus SPP '+spp+'  ?');
				if  (del==true){
					$(document).ready(function(){
                    $.post(urll,({no:spp}),function(data){
                    status = data;                        
                    });
                    });				
				}
				} 
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
                    $("#rektotal_ls").attr('value',n['rektotal']);
                    $("#rektotal1_ls").attr('value',number_format(n['rektotal'],2,'.',','));
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
		$('#det').linkbutton('disable');
		document.getElementById("p1").innerHTML="Sudah di Buat SPM...!!!";
    } else {
		 $('#save').linkbutton('enable');
		 $('#del').linkbutton('enable');
		 $('#sav').linkbutton('enable');
		 $('#dele').linkbutton('enable');
		 $('#det').linkbutton('enable'); 
		document.getElementById("p1").innerHTML="";
    }
    }
    
    
    function tombolnew(){  
     $('#save').linkbutton('enable');
     $('#del').linkbutton('enable');
     $('#det').linkbutton('enable');     
     $('#sav').linkbutton('enable');
     $('#dele').linkbutton('enable');
    }
		

    function cetak_spp3(){ 
            var urll= '<?php echo base_url(); ?>/index.php/tukd/cetakspp3';             			    
         	if (spp !=''){
				var del=confirm('Anda yakin akan mencetak SPP '+nomer+'  ?');
				if  (del==true){
					$(document).ready(function(){
                    $.post(urll,({no:nomer}),function(data){
                    status = data;                        
                    });
                    });				
				}
				} 
	}
        
   
   function openWindow( url )
        {
       
        var no =nomer.split("/").join("123456789");
		var hal=document.getElementById("hal").value;
		var ttd1=$('#ttd').combogrid('getValue');
		var ttd =ttd1.split(" ").join("dd");
		lc= '?cno='+no+'&cttd='+ttd+'&ckode='+kode+'&cjns='+jns+'&chal='+hal;
        // window.open(url+'/'+no+'/'+kode+'/'+jns+'/'+ttd, '_blank');
	    window.open(url+lc, '_blank');
        window.focus();
        }     
   
   function detail(){
        var lcno = document.getElementById('no_spp').value;
            if(lcno !=''){
               section3();               
            } else {
                alert('Nomor SPP Tidak Boleh kosong')
                document.getElementById('no_spp').focus();
                exit();
            }
    }    
    
    
    function runEffect() {
        var selectedEffect = 'blind';            
        var options = {};                      
        $( "#tagih" ).toggle( selectedEffect, options, 500 );
        $("#notagih").combogrid("setValue",'');
        $("#tgltagih").attr("value",'');
        //$("#nmskpd").attr("value",'');
        $("#nil").attr("value",'');
        $("#ni").attr("value",'');
    };        
    
    
    function detail_trans_3(){
        $(function(){
			$('#dgsppls').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams    : ({ spp:no_spp }),
                 idField       : 'idx',
                 toolbar       : "#toolbar",              
                 rownumbers    : "true", 
                 fitColumns    : false,
                 autoRowHeight : "false",
                 singleSelect  : "true",
                 nowrap        : "true",
                 onLoadSuccess : function(data){                      
                 },
                onSelect:function(rowIndex,rowData){
                    
                    kd          = rowIndex ;  
                    idx         =  rowData.idx ;
                    tkdkegiatan = rowData.kdkegiatan ;
                    tkdrek5     = rowData.kdrek5 ;
                    tnmrek5     = rowData.nmrek5 ;
                    tnilai1     = rowData.nilai1 ;
                                                               
                },
                 columns:[[
                     {field:'idx',
					 title:'idx',
					 width:100,
					 align:'left',
                     hidden:'true'
					 },               
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
					 width:280
					 },
                    {field:'nilai',
					 title:'Nilai',
					 width:140,
                     align:'right'
                     },
                    {field:'hapus',title:'Hapus',width:100,align:"center",
                    formatter:function(value,rec){ 
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                    }
                    }
				]]	
			});
		});
        }
        
        
        function detail_kosong(){
            
        var no_spp = '' ; 
        $(function(){
			$('#dgsppls').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                queryParams:({ spp:no_spp }),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"true",
                 onLoadSuccess:function(data){   
                 },
                onSelect:function(rowIndex,rowData){
                kd  = rowIndex ;  
                idx =  rowData.idx ;                                           
                },
                 columns:[[
                     {field:'idx',
					 title:'idx',
					 width:100,
					 align:'left',
                     hidden:'true'
					 },               
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
					 width:280
					 },
                    {field:'nilai1',
					 title:'Nilai',
					 width:140,
                     align:'right'
                     },
                    {field:'hapus',title:'Hapus',width:100,align:"center",
                    formatter:function(value,rec){ 
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                    }
                    }
				]]	
			});
		});
        }
        
        
        function tambah(){
            
           var cek_kegi = $("#kg").combogrid('getValue') ;
           if ( cek_kegi == '') {
                alert('Isi Kode Kegiatan Terlebih Dahulu....!!!') ;
                exit() ;
           } 
           $("#dialog-modal-rek").dialog('open'); 
           $("#rek_skpd").combogrid("disable");
           $("#rek_kegi").combogrid("disable");
           $("#rek_kegi").combogrid("setValue",'');
           $("#nm_rek_kegi").attr("Value",'');
           $("#rek_reke").combogrid("setValue",'');
           $("#nm_rek_reke").attr("Value",'');
           
           var kegi_tmb    = $("#kg").combogrid('getValue') ;
           var nm_kegi_tmb = document.getElementById('nm_kg').value ;
           
           $("#rek_kegi").combogrid("setValue",kegi_tmb);
           $("#nm_rek_kegi").attr("Value",nm_kegi_tmb);
           
           $("#rek_nilai").attr("Value",0);
           $("#rek_nilai_ang").attr("Value",0);
           $("#rek_nilai_spp").attr("Value",0);
           $("#rek_nilai_sisa").attr("Value",0);
        
        }
        
       
       function append_save() {
        
            $('#dgsppls').datagrid('selectAll');
            var rows  = $('#dgsppls').datagrid('getSelections') ;
                jgrid = rows.length ;
        
            var jumtotal  = document.getElementById('rektotal_ls').value ;
                jumtotal  = angka(jumtotal);
        
            var vrek_skpd = $('#rek_skpd').combobox('getValue');
            var vrek_kegi = $('#rek_kegi').combobox('getValue');
            var vrek_reke = $('#rek_reke').combobox('getValue');
            var cnil      = document.getElementById('rek_nilai').value;
            var cnilai    = cnil;      
            
            
            var cnil_sisa   = angka(document.getElementById('rek_nilai_sisa').value) ;
            var cnil_input  = angka(document.getElementById('rek_nilai').value) ;
            
            if ( cnil_input > cnil_sisa ){
                 alert('Nilai Melebihi Sisa Anggaran...!!!, Cek Lagi...!!!') ;
                 exit();
            }
            if ( cnil_input == 0 ){
                 alert('Nilai Nol.....!!!, Cek Lagi...!!!') ;
                 exit();
            }
            
            
            var vnm_rek_reke = document.getElementById('nm_rek_reke').value;
            
            if ( edit == 'F' ){
                pidx = pidx + 1 ;
                }
                
            if ( edit == 'T' ){
                pidx = jgrid ;
                pidx = pidx + 1 ;
                }

            $('#dgsppls').edatagrid('appendRow',{kdkegiatan:vrek_kegi,kdrek5:vrek_reke,nmrek5:vnm_rek_reke,nilai1:cnilai,idx:pidx});
            $("#dialog-modal-rek").dialog('close'); 
            
            jumtotal = jumtotal + angka(cnil) ;
            $("#rektotal_ls").attr('value',number_format(jumtotal,2,'.',','));
            $("#rektotal1_ls").attr('value',number_format(jumtotal,2,'.',','));
            $("#dgsppls").datagrid("unselectAll");
            
       }
       
       
       function hapus_detail(){
        
        var a          = document.getElementById('no_spp').value;
        var rows       = $('#dgsppls').edatagrid('getSelected');
        var ctotalspp  = document.getElementById('rektotal_ls').value ;
        
        bkdrek      = rows.kdrek5;
        bkdkegiatan = rows.kdkegiatan;
        bnilai      = rows.nilai1;
        bbukti      = '';
        
        ctotalspp   = angka(ctotalspp) - angka(bnilai) ;
        
        var idx = $('#dgsppls').edatagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, Rekening : '+bkdrek+'  Nilai :  '+bnilai+' ?');
        
        if ( tny == true ) {
            
            $('#dgsppls').datagrid('deleteRow',idx);     
            $('#dgsppls').datagrid('unselectAll');
            $("#rektotal_ls").attr("Value",number_format(ctotalspp,2,'.',','));
            $("#rektotal1_ls").attr("Value",number_format(ctotalspp,2,'.',','));
              
             var urll = '<?php  echo base_url(); ?>index.php/tukd/dsimpan_spp';
             $(document).ready(function(){
             $.post(urll,({cnospp:a,ckdgiat:bkdkegiatan,ckdrek:bkdrek,cnobukti:bbukti}),function(data){
             status = data;
                if (status=='0'){
                    alert('Gagal Hapus..!!');
                    exit();
                } else {
                    alert('Data Telah Terhapus..!!');
                    exit();
                }
             });
             });    
        }     
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
<h3><a href="#" id="section1" onclick="javascript:$('#spp').edatagrid('reload')">List SPP</a></h3>
    
    <div style="height:450px;">
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:section2();kosong();">Tambah</a>
        <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>              
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="spp" title="List SPP" style="width:870px;height:470px;" >  
        </table>
    </p> 
    </div>

<h3><a href="#" id="section2">Input SPP</a></h3>
   
   <div  style="height:350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>

   <fieldset style="width:850px;height:950px;border-color:white;border-style:hidden;border-spacing:0;padding:0;">            
   <table border='1' style="font-size:11px"  >
   <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
                <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;" colspan="5"><b>P E N A G I H A N </b><input type="checkbox" id="status"  onclick="javascript:runEffect();"/>
                    <div id="tagih">
                        <table>
                            <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
                                <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No.Penagihan</td>
                                <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" id="notagih"/></td>
                            
                                <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl Penagihan</td>
                                <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" id="tgltagih" style="width: 140px;" /></td>
								<td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Nilai </td>
                                <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><input type="text" id="nil" style="width: 140px;" />
                                <input type="hidden" id="ni" style="width: 140px;" /></td>   
                            </tr>
                        </table> 
                    </div>
                
                </td>                
   </tr>
   
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
 </tr>  

 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >   
   <td width="8%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >No SPP</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;<input type="text" name="no_spp" id="no_spp" onclick="javascript:select();"  style="width:250px"/><input type="hidden" name="no_spp_hide" id="no_spp_hide" style="width:140px"/></td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tanggal</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;<input id="dd" name="dd" type="text" /></td>   
 </tr>
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">SKPD</td>
   <td width="53%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >     
      &nbsp;<input id="dn" name="dn"  readonly="true" style="width:130px; border: 0;"/> </td> 
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
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><textarea name="nmskpd" id="nmskpd" cols="40" rows="1" style="border: 0;"  readonly="true"></textarea></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Keperluan</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><textarea name="ketentuan" id="ketentuan" cols="30" rows="1" ></textarea></td>
 </tr>
 <tr>
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No SPD</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;<input id="sp" name="sp" style="width:190px" /></td>
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekanan/Dir.</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><input id="rekanan" name="rekanan" style="width:190px"/>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;
   <input id="dir" name="dir" style="width:190px"/></td>
 </tr>
 
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Kegiatan</td>
   <td colspan="3" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;" >&nbsp;<input id="kg" name="kg" style="width:190px" />
   &nbsp;<input type ="hidden" id="kp" name="kp" style="width:160px" />
    &nbsp;&nbsp;<input id="nm_kg" name="nm_kg" style="width:500px;border: 0;"/>
      <input type ="hidden" id="nm_kp" name="nm_kp" /></td>
 </tr>
 
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Beban</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><select name="jns_beban" id="jns_beban" style="height: 27px; width: 190px;">
     <option value="">...Pilih Jenis Beban... </option>     
     <option value="3">TU</option>
     <option value="4">LS GAJI</option>
     <option value="5">LS PPKD</option>
     <option value="6">LS Barang Jasa</option>
     <option value="7">LS Bendahara</option>
   </select></td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bank</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><?php
								  		$bank1="select * from ms_bank ";
                                        $pagingquery1 = $bank1; //echo "edit  $pagingquery1<br />";
                                        $res = mysql_query($pagingquery1)or die("pagingquery gagal".mysql_error());
								?>
     <select name="bank1" id="bank1" style="height: 27px; width: 190px;">
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
 
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">NPWP</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;<input type="text" name="npwp" id="npwp" value="" style="width:190px"/></td>
   <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekening</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;<input type="text" name="rekening" id="rekening"  value="" style="width:190px"/></td>
 </tr>

     <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">
       <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
       <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
       <td width='8%'  style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
       <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
     </tr>  

       <tr style="border-spacing: 3px;padding:3px 3px 3px 3px;">
                <td colspan="4" align='right' style="border-bottom-color:black;border-spacing: 3px;padding:3px 3px 3px 3px;" >
                <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Baru</a>
                <a id="save" class="easyui-linkbutton" iconCls="icon-save" plain="true"  onclick="javascript:hsimpan();">Simpan</a>
                <a id="del" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hhapus();javascript:section1();">Hapus</a>
                <!--<a id="det" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="javascript:detail();">Detail</a>-->
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a>
                <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a></td>                
       </tr>
</table>

    
        <!------------------------------------------------------------------------------------------------------------------>
        
        <table id="dgsppls" title="Input Detail SPP" style="width:850%;height:300%;" >  
        </table>
        
        <div id="toolbar" align="left">
    		<a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:tambah();">Tambah Rekening</a>
        </div>
  
        <table border='0' style="width:100%;height:5%;"> 
             <td width='39%'></td>
             <td width='15%'><input class="right" type="hidden" name="rektotal1_ls" id="rektotal1_ls"  style="width:140px" align="right" readonly="true" ></td>
             <td width='9%'><B>Total</B></td>
             <td width='32%'><input class="right" type="text" name="rektotal_ls" id="rektotal_ls"  style="width:140px" align="right" readonly="true" ></td>
             <td width='9%'><B>Total SPD</B></td>
             <td width='32%'><input class="right" type="text" name="nilaispd" id="nilaispd"  style="width:140px" align="right" readonly="true" ></td>
        </table>
        </fieldset>
        <!------------------------------------------------------------------------------------------------------------------>
   </div>

</div>
</div> 

<div id="dialog-modal" title="CETAK SPP">
    <p class="validateTips">SILAHKAN PILIH SPP</p>  
    <fieldset>
    <table>
        <tr>            
            <td width="110px">NO SPP</td>
            <td>:&nbsp;&nbsp;<input id="cspp" name="cspp" style="width: 170px;" /></td>
        </tr>
        <tr>
            <td width="110px">Penandatangan</td>
            <td>:&nbsp;&nbsp;<input id="ttd" name="ttd" style="width: 170px;" /></td>
        </tr>
		 <tr>
            <td width="110px">Enter ttd</td>
            <td>:&nbsp;&nbsp;<input id="hal" name="hal" style="width: 30px;" />&nbsp;baris</td>
        </tr>
    </table>  
    </fieldset>
    <div>
    </div>     
    <a href="<?php echo site_url(); ?>/tukd/cetakspp1" class="easyui-linkbutton" plain="true" onclick="javascript:openWindow(this.href);return false;">SPP1</a>
    <a href="<?php echo site_url(); ?>/tukd/cetakspp2" class="easyui-linkbutton" plain="true" onclick="javascript:openWindow(this.href);return false;">SPP2</a>
    <a href="<?php echo site_url(); ?>/tukd/cetakspp3" class="easyui-linkbutton" plain="true" onclick="javascript:openWindow(this.href);return false;">SPP3</a>
	<a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>  
</div>


<div id="dialog-modal-rek" title="Input Rekening">
    <p class="validateTips"></p>  
    <fieldset>
    <table align="center" style="width:100%;" border="0">
       
            <tr>
                <td width='15%'>SKPD</td>
                <td width='3%'>:</td>
                <td width='82%'><input id="rek_skpd" name="rek_skpd" style="width: 200px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="rek_nmskpd" style="border:0;width: 300px;" readonly="true"/></td>                            
            </tr>

            <tr>
                <td>KEGIATAN</td>
                <td>:</td>
                <td><input id="rek_kegi" name="rek_kegi" style="width: 200px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="nm_rek_kegi" style="border:0;width: 300px;" readonly="true"/></td>                            
            </tr>

            <tr>
                <td>REKENING</td>
                <td>:</td>
                <td><input id="rek_reke" name="rek_reke" style="width: 200px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="nm_rek_reke" style="border:0;width: 300px;" readonly="true"/></td>                            
            </tr>

            <tr>
                <td>ANGGARAN</td>
                <td>:</td>
                <td><input type="text" id="rek_nilai_ang" style="width: 196px; text-align: right; " readonly="true" /></td> 
            </tr>
            
            <tr>
                <td>JUMLAH SPP LALU</td>
                <td>:</td>
                <td><input type="text" id="rek_nilai_spp" style="width: 196px; text-align: right; " readonly="true" /></td> 
            </tr>

            <tr>
                <td>SISA ANGGARAN</td>
                <td>:</td>
                <td><input type="text" id="rek_nilai_sisa" style="width: 196px; text-align: right; " readonly="true" /></td> 
            </tr>

            <tr>
                <td>NILAI</td>
                <td>:</td>
                <td><input type="text" id="rek_nilai" style="width: 196px; text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))"/></td> 
            </tr>
            
            <tr>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;</td> 
            </tr>
            
            <tr>
                <td colspan="3" align="center">
                <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();">Simpan</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar_rek();">Keluar</a>  
                </td>
            </tr>
            
    </table>  
    </fieldset>
</div>
</body>
</html>
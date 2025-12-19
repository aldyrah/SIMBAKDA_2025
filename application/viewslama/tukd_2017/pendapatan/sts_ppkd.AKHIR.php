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




    
    
    
    <script type="text/javascript">
    
    var kode = '';
    var giat = '';
    var nomor= '';
    var cid  = 0;
	var cekit= 0;
    var plrek = '';

     $(document).ready(function() {
            $("#accordion").accordion();            
            $( "#dialog-modal" ).dialog({
            height: 200,
            width: 700,
            modal: true,
            autoOpen:false
        });
         $( "#dialog-modal_t" ).dialog({
            height: 500,
            width: 800,
            modal: true,
            autoOpen:false
        });
        $( "#dialog-modal_cetak" ).dialog({
            height: 200,
            width: 400,
            modal: true,
            autoOpen:false
        });
        $( "#dialog-modal_edit" ).dialog({
            height: 200,
            width: 700,
            modal: true,
            autoOpen:false
        });   
        });    
     
     
     $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_sts_ppkd',
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"true",
        singleSelect:"true",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
    	    {field:'no_sts',
    		title:'Nomor STS',
    		width:50},
            {field:'tgl_sts',
    		title:'Tanggal',
    		width:30},
            {field:'kd_skpd',
    		title:'S K P D',
    		width:30,
            align:"left"},
            {field:'keterangan',
    		title:'Uraian',
    		width:50,
            align:"left"}
        ]],
        onSelect:function(rowIndex,rowData){       
          nomor = rowData.no_sts;
          kode  = rowData.kd_skpd;
          tgl   = rowData.tgl_sts;
		  lcket = rowData.keterangan;
		  lctotal = rowData.total;
		  lckdbank = rowData.kd_bank;
		  lckdgiat = rowData.kd_kegiatan;
          lcjnskeg = rowData.jns_trans;
		  lcrekbank = rowData.rek_bank;
		  nomorkas = rowData.no_kas;
          tglkas   = rowData.tgl_kas;
          nocek	=rowData.no_cek;
		  status	=rowData.status;
		  sumber	=rowData.sumber;
		  nm_skpd	=rowData.nm_skpd;
   //alert(rowIndex)
		  $('#cmb_sts').combogrid("setValue",nomorkas);
		  cekit=0;
          get(nomor,kode,tgl,lcket,lctotal,lckdbank,lckdgiat,lcjnskeg,lcrekbank,nomorkas,tglkas,nocek,status,sumber,nm_skpd);
		    //        alert(nomor+kode+tgl+lcket+lctotal+lckdbank+lckdgiat+lcjnskeg+lcrekbank+nomorkas+tglkas+nocek+status+sumber+nm_skpd);
		//  nomorkas,tglkas,nomor,tgl,kode,lckdbank,lckdgiat,lcket,lcjnskeg,lcrekbank,lctotal);   
          load_detail(nomor);                                   
        },
        onDblClickRow:function(rowIndex,rowData){
           //alert(rowData.no_sts);   
		    cekit=0;
            section2();  
			
			mbol(1); 
        }
        });
		
		
		
        $('#dg_tetap').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_tetap_sts/'+kode+'/'+plrek,
        idField:'id',            
        rownumbers:"true", 
        fitColumns:"false",
        autoRowHeight:"false",
        loadMsg:"Tunggu Sebentar....!!",
        pagination:"true",
        nowrap:"true",                       
        columns:[[
            {field:'ck',
    		title:'Pilih',
    		width:5,
            align:"center",
            checkbox:true                
            },
    	    {field:'no_tetap',
    		title:'Nomor Tetap',
    		width:10,
            align:"center"},
            {field:'tgl_tetap',
    		title:'Tanggal',
    		width:5,
            align:"center"},
            {field:'nilai',
    		title:'Nilai',
    		width:5,
            align:"center"}
        ]]
        });
        
        
        $('#dg1').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true", 
            fitColumns:"true",
            singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",            
            nowrap:"true",
            onSelect:function(rowIndex,rowData){                    
                    idx = rowIndex;
                    lnnilai = rowData.rupiah;
            },                                                     
            columns:[[
                {field:'id',
        		title:'ID',    		
                hidden:"true"},
                {field:'no_sts',
        		title:'No STS',    		
                hidden:"true"},                
        	    {field:'kd_rek5',
        		title:'Kode Rekening',
                width:50},
                {field:'nm_rek',
        		title:'Nama Rekening',
                width:400},                
                {field:'rupiah',
        		title:'Nilai',
                align:'right',
                width:300}               
            ]],
            
           onDblClickRow:function(rowIndex,rowData){
           idx = rowIndex; 
           lcrekedt = rowData.kd_rek5;
           lcnmrekedt = rowData.nm_rek;
           lcnilaiedt = rowData.rupiah; 
           get_edt(lcrekedt,lcnmrekedt,lcnilaiedt); 
           
        }
            
            
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
        
        $('#tgl_kas').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
    
        $('#rek').combogrid({  
           panelWidth:700,  
           idField:'kd_rek5',  
           textField:'kd_rek5',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/ambil_rek_tetap/'+kode,             
           columns:[[  
               {field:'kd_rek5',title:'Kode Rekening',width:140},  
               {field:'nm_rek',title:'Uraian',width:700},
              ]],
              
               onSelect:function(rowIndex,rowData){
                plrek = rowData.kd_rek5;
               $("#nmrek1").attr("value",rowData.nm_rek.toUpperCase());

               $("#dg_tetap").edatagrid({url: '<?php echo base_url(); ?>/index.php/tukd/load_tetap_sts/'+kode+'/'+plrek});
              }    
            });
            
          $('#cmb_sts').combogrid({  
           panelWidth:700,  
           idField:'no_sts',  
           textField:'no_sts',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/load_sts_ppkd',  
           columns:[[  
               {field:'no_sts',title:'Nomor STS',width:100},  
               {field:'nm_skpd',title:'Nama SKPD',width:700}    
           ]],  
           onSelect:function(rowIndex,rowData){
               nomor = rowData.no_sts;               
           } 
       });
       
        $('#nomor').combogrid({  
           panelWidth:700,  
           idField:'no_sts',  
           textField:'no_sts',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/ambil_sts/'+kode,  
           columns:[[  
               {field:'no_sts',title:'No Bukti',width:200},  
               {field:'total',title:'Nilai',width:150,align:"right"} ,
               {field:'keterangan',title:'Ket',width:550}    
           ]],  
           onSelect:function(rowIndex,rowData){
               nos = rowData.no_sts;
               kode = rowData.kd_skpd;
               tglsts = rowData.tgl_sts;
               ket = rowData.keterangan;
               giat =rowData.kd_kegiatan;
			   nmgiat=rowData.nm_kegiatan;
               nilai =rowData.total;
			   nilaix =rowData.total1;
               jnst =rowData.jns_trans
			   var tglx= $("#tgl_kas").datebox("getValue");
			   if(tglx==''){
				 $("#tgl_kas").datebox("setValue",tglsts);
			   }
               $("#tanggal").datebox("setValue",tglsts);
               $("#ket").attr("value",ket);
			   $("#nmgiat").attr("value",nmgiat);
               $("#giat").combogrid("setValue",giat);
               $("#jumlahtotal").attr("value",nilai);
			   $("#jumlahtotalx").attr("value",nilaix);
               $("#jns_trans").combobox("setValue",jnst)
               detail(nos); 
           }  
       });
    
        $('#skpd').combogrid({  
           panelWidth:700,  
           idField:'kd_skpd',  
           textField:'kd_skpd',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/rka/skpd',  
           columns:[[  
               {field:'kd_skpd',title:'Kode SKPD',width:100},  
               {field:'nm_skpd',title:'Nama SKPD',width:700}    
           ]],  
           onSelect:function(rowIndex,rowData){
               kode = rowData.kd_skpd;               
               $("#nmskpd").attr("value",rowData.nm_skpd.toUpperCase());
               $('#nomor').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/ambil_sts/'+kode});                 
           }  
       });
       
        $('#jns_trans').combobox({  
        url:'<?php echo base_url(); ?>index.php/tukd/load_jns_rek',  
        valueField:'id',  
        textField:'text',
        onSelect:function(record){
               lcskpd=$('#skpd').combogrid('getValue');
               lckode = record.id;
               $('#giat').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/load_trskpd1/'+lckode+'/'+lcskpd});
           }    
         });  

          $('#cmb_rek').combogrid({  
           panelWidth:700,  
           idField:'kd_rek5',  
           textField:'kd_rek5',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/tukd/ambil_rek/'+kode+'/'+giat,             
           columns:[[  
               {field:'kd_rek5',title:'Kode Rekening',width:140},  
               {field:'nm_rek',title:'Uraian',width:700},
              ]],
              
               onSelect:function(rowIndex,rowData){
               $("#nmrek").attr("value",rowData.nm_rek);
              }    
            });
  
                     
        $('#giat').combogrid({
           panelWidth:700,  
           idField:'kd_kegiatan',  
           textField:'kd_kegiatan',  
           mode:'remote',
           url:'<?php echo base_url(); ?>index.php/rka/load_trskpd/'+kode,             
           columns:[[  
               {field:'kd_kegiatan',title:'Kode Kegiatan',width:140},  
               {field:'nm_kegiatan',title:'Nama Kegiatan',width:700}
           ]],  
           onSelect:function(rowIndex,rowData){
               giat = rowData.kd_kegiatan;
               $("#nmgiat").attr("value",rowData.nm_kegiatan);                                      
           }
              
        });
        
        
    });   
    
	

    function openWindow( url )
        {
        var no =nomor.split("/").join("123456789");
        window.open(url+'/'+no, '_blank');
        window.focus();
        }     

    function loadgiat(){
        var lcjnsrek=document.getElementById("jns_trans").value;
         $('#giat').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/load_trskpd1/'+lcjnsrek});  
    }
    
    function load_detail(kk){        

            $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/tukd/load_dsts_ppkd',
                data: ({no:kk}),
                dataType:"json",
                success:function(data){                                   
                                $.each(data,function(i,n){
                                id = n['id'];    
                                kdrek = n['kd_rek5'];                                                                    
                                lnrp = n['rupiah'];    
                                lcnmrek = n['nm_rek'];
                                lcnosts = n['no_sts'];
                                $('#dg1').datagrid('appendRow',{id:id,no_sts:lcnosts,kd_rek5:kdrek,rupiah:lnrp,nm_rek:lcnmrek});                         
                                });   
                }
            });
           });  
  
         set_grid();
    }
   

     function detail(nosts){
        $(function(){
			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/load_dsts',
                queryParams:({no:nosts}),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"true",
                 singleSelect:false,                                			 				 
                 columns:[[
                            {field:'id',
                    		title:'ID',    		
                            hidden:"true"},
                            {field:'no_sts',
                    		title:'No STS',    		
                            hidden:"true"},                
                    	    {field:'kd_rek5',
                    		title:'Kode Rekening',
                            width:50},
                            {field:'nm_rek',
                    		title:'Nama Rekening',
                            width:400},                
                            {field:'rupiah',
                    		title:'Nilai',
                            align:'right',
                            width:200}               
                        ]]	
			});
		});
        }
 
     function section1(){
         $(document).ready(function(){    
             $('#section1').click();   
             $('#dg').edatagrid('reload');                                              
         });
     }
     function section2(){
         $(document).ready(function(){    
             $('#section2').click();
			 mbol(2);                                               
         });     
     }
       
     
        
    function  get(nomor,kode,tgl,lcket,lctotal,lckdbank,lckdgiat,lcjnskeg,lcrekbank,nomorkas,tglkas,nocek,status,sumber,nm_skpd){
	//get(nomorkas,tglkas,nomor,tgl,kode,lckdbank,lckdgiat,lcket,lcjnskeg,lcrekbank,lctotal){
        $("#no_kas").attr("value",nomorkas); 
		$("#tgl_kas").datebox("setValue",tglkas);
		$("#skpd").combogrid("setValue",kode);   
		$("#nmskpd").attr("value",nm_skpd);
         $("#nomor").combogrid("setValue",nomor); 
		 $("#tanggal").datebox("setValue",tgl);
 		$("#ket").attr("value",lcket);
		$("#jns_trans").combobox("setValue",lcjnskeg);
		$('#giat').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/load_trskpd1/'+lcjnskeg+'/'+kode}); 
        $("#giat").combogrid("setValue",lckdgiat);
        $("#jumlahtotal").attr("value",lctotal);
		$("#jumlahtotalx").attr("Value",number_format(lctotal,2,'.',','));
		

    }
    
    
    function get_edt(lcrekedt,lcnmrekedt,lcnilaiedt){
        $("#rek_edt").attr("value",lcrekedt);
        $("#nmrek_edt").attr("value",lcnmrekedt);
        $("#nilai_edt").attr("value",lcnilaiedt);
        $("#nilai_edth").attr("value",lcnilaiedt);
        $("#dialog-modal_edit").dialog('open');
    } 
    
    function kosong(){
		$("#no_kas").attr("value",'');
        $("#nomor").combogrid("setValue",'');
		$("#tgl_kas").datebox("setValue",'');
        $("#tanggal").datebox("setValue",'');
        $("#skpd").combogrid("setValue",'');
        $("#nmskpd").attr("value",'');
        $("#jns_trans").combobox("setValue",'');
        $("#bank").combogrid("setValue",'');
        $("#ket").attr("value",'');
        $("#nmgiat").attr("value",'');
        $("#jumlahtotal").attr("value",0);
		$("#jumlahtotalx").attr("value",0);
		cekit=1;
		ambil_nomor();
        var kode = '';
        var nomor = '';
        $('#giat').combogrid('setValue','');
		$('#dg1').datagrid('loadData', {"total":0,"rows":[]});
    }
   
	function ambil_nomor(){
		kodex='1.20.05.01';
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>/index.php/tukd/max_nomorxx',
			data: ({ckode:kodex}),
			dataType:"json",
				success: function(data){
				$("#no_kas").attr("value",data.bud)
			}
		});
	}  
	
	
	function mbol(st){
	if (st=='1'){
	$('#a1').linkbutton('disable');
    $('#b1').linkbutton('disable');
		
	}else{
	$('#a1').linkbutton('enable');
    $('#b1').linkbutton('enable');
		
		}
	}

    function cari(){
    var kriteria = document.getElementById("txtcari").value; 
    $(function(){ 
     $('#dg').edatagrid({
		url: '<?php echo base_url(); ?>/index.php/tukd/load_sts_ppkd',
        queryParams:({cari:kriteria})
        });        
     });
    }
    
   function append_save(){
            var ckdrek = $('#cmb_rek').combogrid('getValue');
            var lcno = document.getElementById('nomor').value;
            var lcnm = document.getElementById('nmrek').value;
            var lcnl = angka(document.getElementById('nilai').value);
            var lstotal = angka(document.getElementById('jumlahtotal').value);
            var lcnl1 = number_format(lcnl,0,'.',',');
            if (ckdrek != '' && lcnl != 0 ) {
                total = number_format(lstotal+lcnl,0,'.',',');
                cid = cid + 1;            
                $('#dg1').datagrid('appendRow',{id:cid,no_sts:lcno,kd_rek5:ckdrek,rupiah:lcnl1,nm_rek:lcnm});    
                $('#jumlahtotal').attr('value',total); 
				 $('#jumlahtotalx').attr('value',total);
                rek_filter(); 
            }

		$('#cmb_rek').combogrid('setValue','');
		$('#nilai').attr('value','0');
		$('#nmrek').attr('value','');
    }     
    
    
    function rek_filter(){
        var crek='';
         $('#dg1').datagrid('selectAll');
            var rows = $('#dg1').datagrid('getSelections');           
			for(var i=0;i<rows.length;i++){
				crek   = crek+"A"+rows[i].kd_rek5+"A";
                if (i<rows.length && i!=rows.length-1){
                    crek = crek+'B';
                }
            }
               $('#dg1').datagrid('unselectAll');
          $('#cmb_rek').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/ambil_rek/'+kode+'/'+giat+'/'+crek});  
    }
    
    function set_grid(){
        $('#dg1').edatagrid({  
            columns:[[
                {field:'id',
        		title:'ID',    		
                hidden:"true"},
                {field:'no_sts',
        		title:'No STS',    		
                hidden:"true"},                
        	    {field:'kd_rek5',
        		title:'Kode Rekening',
                width:100},
                {field:'nm_rek',
        		title:'Nama Rekening',
                width:250},                
                {field:'rupiah',
        		title:'Nilai',
                align:'right',
                width:100} 
            ]]
        });    
    }
    
    
    function tambah(){
	   var lcno = $('#nomor').combogrid("getValue");
		if(lcno !=''){    
		$("#dialog-modal").dialog('open');
		$('#nilai').attr('value','0');
		$('#nmrek').attr('value','');
		var kode = $('#skpd').combogrid('getValue');
		var giat = $('#giat').combogrid('getValue');
		} else {
			alert('Nomor Sts Tidak Boleh kosong')
			document.getElementById('nomor').focus();
			exit();
		}
		
		rek_filter();
    }
    
    function cetak(){
        $("#dialog-modal_cetak").dialog('open');             
    }
    
    function keluar(){
        $("#dialog-modal").dialog('close');
        $("#dialog-modal_t").dialog('close');
        $("#dialog-modal_cetak").dialog('close');
        $("#dialog-modal_edit").dialog('close');
    }    

    function hapus_rek(){
        var lckurang = angka(lnnilai);
        var lstotal = angka(document.getElementById('jumlahtotal').value);
        lntotal =  number_format(lstotal - lckurang,0,'.',',');
        
        $("#jumlahtotal").attr("value",lntotal);
		 $("#jumlahtotalx").attr("value",lntotal);
                
        $('#dg1').datagrid('deleteRow',idx);     
    }

     function hapus(){
        var cnomor = nomor;
		var cskpd  = kode;
		var cnokas = document.getElementById('no_kas').value;
        var urll = '<?php echo base_url(); ?>index.php/tukd/hapus_sts_ppkd';
		swal({
			  title: "Apakah anda yakin?",
			  text: "Anda Akan Menghapus "+cnomor+" !!!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, delete it!",
			  closeOnConfirm: false
			},
			function(isConfirm){
			if (isConfirm) {
        $(document).ready(function(){
         $.post(urll,({no:cnomor,skpd:cskpd,nokas:cnokas}),function(data){
            status = data;
           	if (data = 1){
						swal("Deleted!", "Data Terhapus", "success");
						section1();
							}
						
						});
                    });				
				}else{
					
					swal("Cancelled", "Your imaginary file is safe :)", "error");
					exit();
				}
				});
		   
		   
		   
		   
		   
		   
		   
		   
         }
         
    
    
    function simpan_sts(){
        var cno = $('#nomor').combogrid('getValue');
        var cnokas = document.getElementById('no_kas').value;
        var ctglkas = $('#tgl_kas').datebox('getValue');
        var cbank = '';
        var ctgl = $('#tanggal').datebox('getValue');
        var cskpd = $('#skpd').combogrid('getValue');
        var lcket = document.getElementById('ket').value;
        var cjnsrek = $('#jns_trans').combobox('getValue');
        var cgiat = $('#giat').combogrid('getValue');
        var lcrekbank ='';
        var lntotal = document.getElementById('jumlahtotal').value;
    // alert(lntotal);
        if (cno==''){
            alert('Nomor STS Tidak Boleh Kosong');
            exit();
        } 
        if (ctglkas==''){
            alert('Tanggal STS Tidak Boleh Kosong');
            exit();
        }
        if (cskpd==''){
            alert('Kode SKPD Tidak Boleh Kosong');
            exit();
        }
                
        $('#dg1').datagrid('selectAll');
        var rows = $('#dg1').datagrid('getSelections');           
		lcval_det = '';
        for(var i=0;i<rows.length;i++){
			cnosts   = rows[i].no_sts;
            ckdrek  = rows[i].kd_rek5;              
            cnilai  = angka(rows[i].rupiah);  
            if(i>0){
				lcval_det = lcval_det+",('"+cskpd+"','"+cnosts+"','"+ckdrek+"','"+cnilai+"')";
			}else{
				lcval_det = lcval_det+"('"+cskpd+"','"+cnosts+"','"+ckdrek+"','"+cnilai+"')";
			}              
		}
        
        $('#dg1').datagrid('unselectAll'); 
        
        $(document).ready(function(){
            	swal({
				title: "Proses penyimpanan.....!!!",
				text: "Please wait . . . . . . . . .",
				timer: 1100,
				showConfirmButton: false
			});
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/tukd/simpan_sts_ppkd',
				
                data: ({tabel:'trhkasin_ppkd',nokas:cnokas,tglkas:ctglkas,no:cno,bank:cbank,tgl:ctgl,skpd:cskpd,ket:lcket,jnsrek:cjnsrek,giat:cgiat,rekbank:lcrekbank,total:lntotal,value_det:lcval_det,ccek:cekit}),
                dataType:"json",
                success:function(data){
                    //status = data.pesan;
					cekit=0;
                    if(data=1){
                        
						swal("TERSIMPAN!", "Proses Berhasil", "success");
						section1();
						 $('#dg').edatagrid('reload');
                    }else{
						     swal("GAGAL!", "Proses Gagal", "error");

					}
                }
                
            });
        });
        
       
    }
    
    function jumlah(){
        var lcno = document.getElementById('nomor').value;
        var lcnm = document.getElementById('nmrek1').value;
        ckdrek = $('#rek').combogrid('getValue'); 
        var rows = $('#dg_tetap').datagrid('getChecked');
        cid = cid + 1;      
        
        var lstotal = angka(document.getElementById('jumlahtotal').value);
 
        var lnjm = 0;    
        	for(var i=0;i<rows.length;i++){
        	   ltmb = angka(rows[i].nilai);
               lnjm = lnjm + ltmb;
                               
        	   }
  
            total = number_format(lstotal+lnjm,0,'.',',');
            $('#jumlahtotal').attr('value',total);    
            lcjm = number_format(lnjm,0,'.',',')   
			 $('#jumlahtotalx').attr('value',lcjm);  

            $('#dg1').datagrid('appendRow',{id:cid,no_sts:lcno,kd_rek5:ckdrek,rupiah:lcjm,nm_rek:lcnm});
             
          keluar();
    }
  
    function delCommas(nStr){
        var no =nStr.split(",").join("");
        return no1 = eval(no);
    }
    
    function edit_detail(){
         var lnnilai = angka(document.getElementById('nilai_edt').value);
         var lnnilai_sb = angka(document.getElementById('nilai_edth').value);
         var lstotal = angka(document.getElementById('jumlahtotal').value);
         
         lcnilai = number_format(lnnilai,0,'.',',');
         total = lstotal - lnnilai_sb + lnnilai; 
         ftotal = number_format(total,0,'.',',');
         $('#dg1').datagrid('updateRow',{
            	index: idx,
            	row: {
            		rupiah: lcnilai                    
            	}
         });
         $('#jumlahtotal').attr('value',ftotal);  
		  $('#jumlahtotalx').attr('value',ftotal);
         keluar();
    }
    
    </script>

</head>
<body>
<div id="content">  
<div id="accordion">
<h3><a href="#" id="section1">List STS</a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:section2();kosong();">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus();section1();">Hapus</a>
        <a class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:cetak();">Cetak</a>
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="dg" title="List STS" style="width:870px;height:450px;" >  
        </table>
    </p> 
    </div>   

<h3><a href="#" id="section2" >Surat Tanda Setoran</a></h3>
   <div  style="height: 350px;">
   <p>       
        <table align="center" style="width:100%;" border="0">
            <tr>
                <td>No. Kas</td>
                <td><input type="text" id="no_kas" style="width: 200px;"/></td>
                <td>Tanggal Kas</td>
                <td><input type="text" id="tgl_kas" name="tgl_kas" style="width: 140px;"/></td>     
            </tr> 
            <tr>
                <td>S K P D</td>
                <td><input id="skpd" name="skpd" style="width: 140px;" /></td>
                <td colspan="2" align="left"><input type="text" id="nmskpd" style="border:0;width: 450px;" readonly="true"/></td>
                                
            </tr>
            <tr>
                <td>No. Bukti</td>
                <td><input type="text" id="nomor" style="width: 200px;"/></td>
                <td>Tanggal Bukti</td>
                <td><input type="text" id="tanggal" style="width: 140px;" /></td>   
            </tr>
            <tr>
                <td>Uraian</td>
                <td colspan="3"><input type="text" id="ket" style="width: 700px;"/></td>                
            </tr>            
            <tr>
                <td>Jenis Transaksi</td>
                <td colspan="3">
                <input  id="jns_trans" name="jns_trans" style="border:0;width: 150px;"/>                 
                </td> 
            </tr>
            <tr>
            <td>Kegiatan</td>
            <td colspan="3"><input id="giat" name="skpd" style="width: 200px;" /></td>
            </tr>
            <tr><td></td>
            <td colspan="3"><input type="text" id="nmgiat" style="border:0;width: 450px;" readonly="true"/></td></tr>
            <tr>
                <td colspan="4" align="right"><a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:simpan_sts();">Simpan</a>
		            <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section1();">Kembali</a></td>                
            </tr>
        </table>          
        <table id="dg1" title="Detail STS" style="width:870px;height:450px;" >  
        </table>  
        <div id="toolbar">
    		<a  id="a1" class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:tambah();">Tambah Rekening</a>
    		<a id="b1" class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hapus_rek();">Hapus Rekening</a>    		
        </div>
 
   </p>
   <table border="0" align="right" style="width:100%;"><tr>
   <td style="width:75%;" align="right"><B>JUMLAH</B></td>
   <td align="right"><input type="text" id="jumlahtotal" readonly="true" style="border:0; width: 200px;" hidden="true" /><input type="text" id="jumlahtotalx" readonly="true" style="border:0; width: 200px;"/></td>
   </tr>
   </table>
   
   </div>
</div>
</div>

<div id="dialog-modal" title="Input Rekening">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
    <table>
        <tr>
            <td width="40px">Kode Rekening:</td>
            <td><input id="cmb_rek" name="cmb_rek" style="width: 200px;" /></td>
        </tr>
        <tr>
            <td width="110px">Nama Rekening:</td>
            <td><input type="text" id="nmrek" readonly="true" style="border:0;width: 400px;"/></td>
        </tr>
        <tr> 
           <td width="70px">Nilai:</td>
           <td><input type="text" id="nilai" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))"/></td>
        </tr>
    </table>  
    </fieldset>
    <a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:append_save();">Simpan</a>
	<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>  
</div>

<div id="dialog-modal_edit" title="Edit Rekening">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
    <table>
        <tr>
            <td width="110px">Kode Rekening:</td>
            <td><input type="text" id="rek_edt" readonly="true" style="width: 200px;" /></td>
        </tr>
        <tr>
            <td width="110px">Nama Rekening:</td>
            <td><input type="text" id="nmrek_edt" readonly="true" style="border:0;width: 400px;"/></td>
        </tr>
        <tr> 
           <td width="110px">Nilai:</td>
           <td><input type="text" id="nilai_edt" style="text-align: right;" onkeypress="return(currencyFormat(this,',','.',event))"/>
               <input type="hidden" id="nilai_edth"/> 
           </td>
        </tr>
    </table>  
    </fieldset>
    <a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:edit_detail();">Simpan</a>
	<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>  
</div>


<div id="dialog-modal_cetak" title="Cetak STS">
    <p class="validateTips">Semua Inputan Harus Di Isi.</p> 
    <fieldset>
    <table>
        <tr>
            <td width="110px">No STS:</td>
            <td><input id="cmb_sts" name="cmb_sts" style="width: 200px;" /></td>
        </tr>
    </table>  
    </fieldset>
     <fieldset>
    <table border="0">
        <tr align="center">
            <td></td>
            <td width="100%" align="center"><a  href="<?php echo site_url(); ?>/tukd/cetak_sts" class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="javascript:openWindow(this.href);return false">Cetak</a>
            <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a>  </td>
        </tr>
    </table>  
    </fieldset>
</div>

<div id="dialog-modal_t" title="Checkbox Select">
<table border="0">
<tr>
<td>Rekening</td>
<td><input id="rek" name="rek" style="width: 140px;" />  <input type="text" id="nmrek1" style="border:0;width: 400px;" readonly="true"/></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr><td colspan="2">
    <table id="dg_tetap" style="width:770px;height:350px;" >  
        </table>
    </td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr><td colspan="2" align="center">
    <a class="easyui-linkbutton" iconCls="icon-save" plain="false" onclick="javascript:jumlah();">Simpan</a>
	<a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:keluar();">Keluar</a></td>
</tr>
</table>  
</div>
</body>
</html>
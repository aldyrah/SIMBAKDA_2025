<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
   
    var no_lpj   = '';
    var kode     = '';
    var spd      = '';
    var st_12    = 'edit';
    var nidx     = 100
    var spd2     = '';
    var spd3     = '';
    var spd4     = '';
    var lcstatus = '';
    
    $(document).ready(function() {
            $("#accordion").accordion();
            $("#lockscreen").hide();                        
            $("#frm").hide();
            
        get_skpd();
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
        
        
        $('#dd1').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });
        
        
        $('#dd2').datebox({  
            required:true,
            formatter :function(date){
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	return y+'-'+m+'-'+d;
            }
        });


         $('#sp2d').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/load_sp2d_lpj_tu',  
                    idField:'no_sp2d',  
                    textField:'no_sp2d',
                    mode:'remote',  
                    fitColumns:true,                       
                    columns:[[  
                        {field:'no_sp2d',title:'No SP2D',width:100},  
                        {field:'tgl_sp2d',title:'Tanggal',align:'left',width:25},
                        {field:'nilai',title:'Nilai',align:'right',width:30}                          
                    ]],
                    onSelect:function(rowIndex,rowData){
                    sp2d   = rowData.no_sp2d;
                                                                            
                    }    
                });




                
          $('#spp').edatagrid({
    		url: '<?php echo base_url(); ?>/index.php/tukd/load_lpj_tu',
            idField:'id',            
            rownumbers:"true", 
            fitColumns:"true",
          rowStyler:function(index,row){
        if (row.setuju >0 && row.a <1){
		   return 'background-color:#33ccff;';
		}else if (row.setuju >0 && row.a >0){
		   return 'background-color:#00ff99;';
		}
    },
			singleSelect:"true",
            autoRowHeight:"false",
            loadMsg:"Tunggu Sebentar....!!",
            pagination:"true",
			
			
            nowrap:"true",                       
            columns:[[
        	    {field:'no_lpj',
        		title:'NO LPJ',
        		width:60},
                {field:'tgl_lpj',
        		title:'Tanggal',
        		width:40},
                {field:'nm_skpd',
        		title:'Nama SKPD',
        		width:170,
                align:"left"},
                {field:'ket',
        		title:'Keterangan',
        		width:110,
                align:"left"}
            ]],
            onSelect:function(rowIndex,rowData){
              nomer     = rowData.no_lpj;         
              kode      = rowData.kd_skpd;
              tgllpj	= rowData.tgl_lpj;
              tglawal	= rowData.tgl_awal;
              tglakhir	= rowData.tgl_akhir;
              cket		= rowData.ket;
              status	= rowData.status_lpj;
			        setuju	= rowData.setuju;
              no_sp2d = rowData.no_sp2d;
              nmskpd = rowData.nm_skpd;

                    
              get(nomer,kode,tgllpj,cket,status,tglawal,tglakhir,setuju,no_sp2d,nmskpd);
              detail_trans_3();
              load_sum_lpj(); 
              lcstatus = 'edit';                                       
            },
            onDblClickRow:function(rowIndex,rowData){
              $('#dn').combogrid('disable');
              $('#sp2d').combogrid('disable');
              $('#no_lpj').attr('disabled',true);
              $('#dd').datebox('disable');
                section1();
            }
        });
                
           
//==grid view edit
            var nlpj      = document.getElementById('no_lpj').value;
			  
 			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1_lpj_tu',
				 queryParams:({ lpj:nlpj }),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"false",
                 columns:[[
                    {field:'idx',title:'idx',width:100,align:'left',hidden:'true'},
                    {field:'jns_spp',title:'Jenis',width:100,align:'left',hidden:'true'},               
                    {field:'no_bukti',title:'No Bukti',width:100,align:'left'},                                          
                    {field:'kdkegiatan',title:'Kegiatan',width:150,align:'left'},
				            {field:'kdrek5',title:'Rekening',width:70,align:'left'},
				            {field:'nmrek5',title:'Nama Rekening',width:280},
                    {field:'nilai1',title:'Nilai',width:140,align:'right'},
                    {field:'hapus',title:'',width:35,align:"center",
                    formatter:function(value,rec){ 
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                    }
                    }
				]]	
            }); 
			
   	});
        
           
        
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
         

    
    function get_skpd()
        {
        	$('#dn').combogrid({  
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
               $("#nmskpd").attr("value",rowData.nm_skpd);
               /*$('#sp2d').combogrid({url:'<?php echo base_url(); ?>index.php/tukd/load_sp2d_lpj_tu',
                                     queryParams:({kode:kode})
                                     });*/
          ambilsp2d();
           }  
         });
        }         
    
    
    
    
	     function get(nomer,kode,tgllpj,cket,status,tglawal,tglakhir,setuju,no_sp2d,nmskpd){
				$("#no_lpj").attr("value",nomer);
				$("#dn").combogrid('setValue',kode);		
				$("#dd").datebox("setValue",tgllpj);
				$("#dd1").datebox("setValue",tglawal);
				$("#dd2").datebox("setValue",tglakhir);
				$("#keterangan").attr("Value",cket);
				$("#no_lpjx").attr("value",nomer);
				$('#sp2d').combogrid('setValue',no_sp2d);
        $("#nmskpd").attr("value",nmskpd);
				if ((status == undefined) || (status =='')|| (status =='null') ){
					status='0';
				}else{		
					status='1';		
				}
			tombol(setuju);           
        }
	
                                 
        
		
        function kosong(){
      $('#dn').combobox('enable');
      $('#sp2d').combogrid('enable');
      $('#sp2d').combogrid('grid').datagrid('reload');
      $("#no_lpj").attr("value",'');
      $("#no_lpj").attr("disabled",false);
			$("#no_lpjx").attr("value",'');
			$("#dd").datebox("setValue",'');
			$("#keterangan").attr("value",'');
			$("#no_lpj").focus();	
      $('#sp2d').combogrid('clear');
      $("#sp2d").combogrid("setValue",'');
      $('#dn').combobox('clear');
      $('#dn').combobox('enable');		
			$('#save').linkbutton('enable');
      $("#nmskpd").attr("value",'');
			st_12 = 'baru';
			tombol();
			detail_trans_kosong();
			lcstatus = 'tambah'
			$("#rektotal").attr('value',0);
        }

		
    function getRowIndex(target){  
			var tr = $(target).closest('tr.datagrid-row');  
			return parseInt(tr.attr('datagrid-row-index'));  
		} 
       
    
    function cetak(){
        var nom=document.getElementById("no_spp").value;
        $("#dialog-modal").dialog('open');
    } 
    
    
    function keluar(){
        $("#dialog-modal").dialog('close');
    } 
    
    
    function keluar_no(){
        $("#dialog-modal-tr").dialog('close');
    }
      
    
    function cari(){
     var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
            $('#spp').edatagrid({
	       url: '<?php echo base_url(); ?>/index.php/tukd/load_lpj_tu',
         queryParams:({cari:kriteria})
        });        
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
     
     
     function section5(){
         $(document).ready(function(){    
             $("#dialog-modal-tr").click();                                               
         });
     }
     
    function tambah_no(){
        judul = 'Input Data No Transaksi';
        $("#dialog-modal-tr").dialog({ title: judul });
        $("#dialog-modal-tr").dialog('open');
        
        document.getElementById("no_spp").focus();
        
        if ( st_12 == 'baru' ){
        $("#no1").attr("value",'');
        $("#no2").attr("value",'');
        $("#no3").attr("value",'');
        $("#no4").attr("value",'');
        $("#no5").attr("value",'');
        }
     }
     
     function tambah_no2(){
        judul = 'Input Data No Transaksi';
        $("#dialog-modal-tr").dialog({ title: judul });
        $("#dialog-modal-tr").dialog('open');
        document.getElementById("no_spp").focus();
        
        if ( st_12 == 'baru' ){
        $("#no1").attr("value",'');
        $("#no2").attr("value",'');
        $("#no3").attr("value",'');
        $("#no4").attr("value",'');
        $("#no5").attr("value",'');
        }
     } 
     
     
     function simpan(){        
        var nlpj      = document.getElementById('no_lpj').value;
   		var b      = $('#dd').datebox('getValue');  
    	var c      = $('#dd1').datebox('getValue');
    	var d      = $('#dd2').datebox('getValue');
	    var nket      = document.getElementById('keterangan').value;
		  var nosp2d = $('#sp2d').combobox('getValue');
		if(nlpj==''){
		swal("Oops...", "NO LPJ BELUM DI ISI!", "error");
		exit();
		}
    if(nosp2d==''){
    swal("Oops...", "NO SP2D BELUM DI ISI!", "error");
    exit();
    }
		
		if(b==''){
		swal("Oops...", "TANGGAL BELUM DI ISI!", "error");
		exit();
		}
		
		if(c==''){
		swal("Oops...", "TANGGAL TRANSAKSI BELUM DI ISI!", "error");
		exit();
		}
		
		if(d==''){
		swal("Oops...", "TANGGAL TRANSAKSI BELUM DI ISI!", "error");
		exit();
		}
		
			if(nket==''){
		swal("Oops...", "KETERANGAN BELUM DI ISI!", "error");
		exit();
		}
		
		
		
		
		if ( lcstatus=='tambah' ) {
		 $.ajax({url: '<?php echo base_url(); ?>index.php/tukd/cek_lpj',   
			type: "POST",
			dataType:'json',                             
			data:({nlpj:nlpj}),						 
				 success:function(data)				 
				 {
					if (data.jml >0) {
						swal({
			 title:"<a style='font-size:large;'>No LPJ </a> <a style='color:red;font-size:large;'>"+nlpj+"</a> <a style='font-size:large;'>Sudah Di Pakai!!!</a>" ,
			  text: "Cek ulang No LPJ atau ganti dengan no lain!! ",
			  html:true,
			  confirmButtonColor:"#ff0000",
			  type: "error",
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});	
						//alert('Data Dengan No LPJ '+nlpj +' Sudah Ada Ganti Dengan Yang Lain...!!!');
						

						exit();
					}else{
						var w=1;
						save_detail(w);
					}
				 }
		 });
		}else{
			var w=2;
			save_detail(w);
		
		}

    }
    
	function save_detail(w){
	    var cnlpj   = document.getElementById('no_lpj').value;
		var cnlpjx   = document.getElementById('no_lpjx').value;
   		var b      = $('#dd').datebox('getValue');  
    	var c      = $('#dd1').datebox('getValue');
    	var d      = $('#dd2').datebox('getValue');
	    var nket   = document.getElementById('keterangan').value;
		var user   ='<?php echo $this->session->userdata('pcNama'); ?>';
		var update  ='<?php echo date('Y-m-d H:m:s'); ?>';
    var nosp2d = $('#sp2d').combobox('getValue');
            $('#dg1').datagrid('selectAll');
            var rows = $('#dg1').datagrid('getSelections');           
			for(var p=0;p<rows.length;p++){
				nlpj      = cnlpj;
				tgllpj    = b;
				ket       = nket;
				tglawal   = c;
				tglakhir  = d;
        jns_spp    = rows[p].jns_spp;
				cnobukti1 = rows[p].no_bukti;
				ckdgiat   = rows[p].kdkegiatan;
				cnmgiat   = rows[p].nmkegiatan;
				ckdrek    = rows[p].kdrek5;
				cnmrek    = rows[p].nmrek5;
				cnilai    = angka(rows[p].nilai1);    
				
                if (p>0) {
                    csql = csql+","+"('"+nlpj+"','"+cnobukti1+"','"+tgllpj+"','"+ket+"','"+ckdgiat+"','"+ckdrek+"','"+tglawal+"','"+tglakhir+"','"+cnilai+"','"+user+"','"+update+"','"+nosp2d+"','"+jns_spp+"')";
                } else {
                    csql = "values('"+nlpj+"','"+cnobukti1+"','"+tgllpj+"','"+ket+"','"+ckdgiat+"','"+ckdrek+"','"+tglawal+"','"+tglakhir+"','"+cnilai+"','"+user+"','"+update+"','"+nosp2d+"','"+jns_spp+"')";                                            
                } 
			}
			
		
			 $(document).ready(function(){
                $.ajax({
                    type: "POST",    
                    dataType:'json',                    
                    data: ({no:cnlpj,sql:csql,cek:w,nox:cnlpjx}),
                    url : "<?php  echo base_url(); ?>index.php/tukd/simpan_lpj_tu",
                    success:function(data){
                          $('#dg1').datagrid('unselectAll');
						  status=data.pesan
						  if(w==1){
							if (status==1){
								//swal("Saved!", "Your imaginary file has been Saved.", "success"); 
								swal({
			  title: 'Data Tersimpan..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
							}else{
								//swal("Oops...", "Something went wrong!", "error");
								swal("Oops...", "Gagal Simpan!", "error");
							}
						  }else{
							if (status==1){
				//				swal("Updated!", "Your imaginary file has been Updated.", "success"); 
				swal({
			  title: 'Data Telah Di Update..!!',
			  text: "Akan Menutup Dalam 2 Detik!!!",
			  confirmButtonColor: "#80C8FE",
			  type: "success",
			  timer: 3500,
			  confirmButtonText: "Ya",
			  showConfirmButton: true
			});
							}else{
								//swal("Oops...", "Something went wrong!", "error");
								swal("Oops...", "Gagal Simpan!", "error");
							}
						  }
                    }                                        
                });
            });                   
  
  }
  
    function kembali(){
        $('#kem').click();
    }                
    
    
     function load_sum_lpj(){          
        
        $(function(){      
         $.ajax({
            type: 'POST',
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_lpj",
            data:({lpj:nomer}),
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){

                    $("#rektotal").attr('value',number_format(n['cjumlah'],2,'.',','));
                });
            }
         });
        });
    }
    
    
    function load_sum_tran(){                
        $(function(){      
         $.ajax({
            type: 'POST',
            data:({no_bukti:no_bukti}),
            url:"<?php echo base_url(); ?>index.php/tukd/load_sum_tran",
            dataType:"json",
            success:function(data){ 
                $.each(data, function(i,n){
                    $("#rektotal").attr('value',number_format(n['rektotal'],2,'.',','));
                    $("#rektotal1").attr('value',number_format(n['rektotal'],2,'.',','));

                });
            }
         });
        });
    }
   
   
    function tombol(st){  
    if (st=='1') {
        $('#save').linkbutton('disable');
        $('#del').linkbutton('disable');
        $('#sav').linkbutton('disable');
        $('#dele').linkbutton('disable');   
        $('#load').linkbutton('disable');
        $('#load_kosong').linkbutton('disable'); 
        document.getElementById("p1").innerHTML="Sudah di Setujui...!!!";
     } else {
         $('#save').linkbutton('enable');
         $('#del').linkbutton('enable');
         $('#sav').linkbutton('enable');
         $('#dele').linkbutton('enable');
         $('#load').linkbutton('enable');
         $('#load_kosong').linkbutton('enable'); 
         document.getElementById("p1").innerHTML="";
     }
    }	
    
        
    function openWindow(url)
    {
        var vnospp  =  $("#cspp").combogrid("getValue");
         
		        lc  =  "?nomerspp="+vnospp+"&kdskpd="+kode+"&jnsspp="+jns ;
        window.open(url+lc,'_blank');
        window.focus();
    }
    
        
    function detail_trans_3(){
        //alert(nomer);
        $(function(){
			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1_lpj_tu',
                queryParams:({ lpj:nomer }),
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
                      {field:'jns_spp',
                       title:'Jenis',
                       width:100,
                       align:'left',
                     hidden:'true'
                       },               
                     {field:'no_bukti',
            					 title:'No Bukti',
            					 width:100,
            					 align:'left'
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
                    {field:'hapus',title:'',width:35,align:"center",
                    formatter:function(value,rec){ 
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                    }
                    }
				]]	
			});
		});
        }
        

        function detail_trans_kosong(){
        var no_kos = '' ;
        $(function(){
			$('#dg1').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/select_data1_lpj_tu',
                queryParams:({ lpj:no_kos }),
                 idField:'idx',
                 toolbar:"#toolbar",              
                 rownumbers:"true", 
                 fitColumns:false,
                 autoRowHeight:"false",
                 singleSelect:"true",
                 nowrap:"true",
                 columns:[[
                     {field:'idx',
            					 title:'idx',
            					 width:100,
            					 align:'left',
                     hidden:'true'
					           }, 
                     {field:'jns_spp',
                       title:'Jenis',
                       width:100,
                       align:'left',
                     hidden:'true'
                       },                  
                     {field:'no_bukti',
            					 title:'No Bukti',
            					 width:100,
            					 align:'left'
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
                    {field:'hapus',title:'',width:35,align:"center",
                    formatter:function(value,rec){ 
                    return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail_grid();" />';
                    }
                    }
				]]	
			});
		});
        }
    
        
 
    
    function hapus_detail(){
        
        var a          = document.getElementById('no_lpj').value;
        var rows       = $('#dg1').edatagrid('getSelected');
        var ctotal_lpj = document.getElementById('rektotal').value;
        jns_spp      = rows.jns_spp;
        bbukti      = rows.no_bukti;
        bkdrek      = rows.kdrek5;
        bkdkegiatan = rows.kdkegiatan;
        bnilai      = rows.nilai1;
        ctotal_lpj  = angka(ctotal_lpj) - angka(bnilai) ;
        if(lcstatus=='tambah'){
        var idx = $('#dg1').edatagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, No Bukti :  '+bbukti+'  Rekening :  '+bkdrek+'  Nilai :  '+bnilai+' ?');
        
        if ( tny == true ) {
            
            $('#rektotal').attr('value',number_format(ctotal_lpj,2,'.',','));
            $('#dg1').datagrid('deleteRow',idx);     
            $('#dg1').datagrid('unselectAll');
            
             status = data;
                if (status=='0'){
                    swal('Gagal Hapus..!!');
                    exit();
                } else {
                    swal('Data Telah Terhapus..!!');
                    exit();
                }
            }    
        } else{
          alert('Tidak Boleh Menghapus Detail');
          exit();
        }

    }
    
  function hhapus(){				
            var lpj = document.getElementById("no_lpj").value;              
            var urll= '<?php echo base_url(); ?>/index.php/tukd/hhapuslpj';             			    
         	if (spp !=''){
					swal({
		  title:"<a style='font-size:large;'>No LPJ </a> <a style='color:red;font-size:large;'>"+lpj+"</a> <a style='font-size:large;'>Akan Dihapus!!!</a>" ,
		  text:"Apakah anda yakin akan Menghapus??",
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
                    $.post(urll,({no:lpj}),
					function(data){
                    status = data;
					if (data = 1){
						swal("Deleted!", "Data Terhapus", "success");
						section4();
							}  
						
						});
                    });				
				}
				});
				} 
	}
  
    function hapus_detail_grid(){
        
        var a          = document.getElementById('no_lpj').value;
        var rows       = $('#dg1').edatagrid('getSelected');
        var ctotal_lpj = document.getElementById('rektotal').value;
        jns_spp      = rows.jns_spp;
        bbukti      = rows.no_bukti;
        bkdrek      = rows.kdrek5;
        bkdkegiatan = rows.kdkegiatan;
        bnilai      = rows.nilai1;
        ctotal_lpj  = angka(ctotal_lpj) - angka(bnilai) ;
        
        var idx = $('#dg1').edatagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, No Bukti :  '+bbukti+'  Rekening :  '+bkdrek+'  Nilai :  '+bnilai+' ?');
        
        if ( tny == true ) {
            
            $('#rektotal').attr('value',number_format(ctotal_lpj,2,'.',','));
            $('#dg1').datagrid('deleteRow',idx);     
            $('#dg1').datagrid('unselectAll');
               
        }     
    }

    function ambilsp2d(){
      var skpd = $('#dn').combobox('getValue');
      $("#sp2d").combogrid("setValue",'');
      $(function(){
      $('#sp2d').combogrid({  
           panelWidth:500,  
           idField:'no_sp2d',  
           textField:'no_sp2d',  
           mode:'remote',
           url :'<?php echo base_url(); ?>index.php/tukd/load_sp2d_lpj_tu',
           queryParams:({kode:skpd}),
           fitColumns:true,                        
           columns:[[  
               {field:'no_sp2d',title:'Nomor Sp2d',width:100},  
               {field:'tgl_sp2d',title:'Tanggal',width:25},
               {field:'nilai',title:'Nilai',width:30,align:'right'}    
           ]],  
           onSelect:function(rowIndex,rowData){
               $('#nilsp2d').attr('value',rowData.nilai);            
           }  
       });
    });
}
  

  
    
    function load_data() {
        var sp2d = $('#sp2d').combobox('getValue');
        var dtgl1        = $('#dd1').datebox('getValue') ;
        var dtgl2        = $('#dd2').datebox('getValue') ;
        var kode =$('#dn').combobox('getValue');
		var total        = 0;
		    if(sp2d==''){
          alert('Nomor SP2D Tidak Boleh Kosong');
          exit();
        }
        if ( dtgl1 == '' ) {
           alert('Isi Tanggal Awal Terlebih Dahulu...!!!'); 
           document.getElementById('dd1').focus() ;
           exit();
           }       
        if ( dtgl2 == '' ) {
           alert('Isi Tanggal S/D Terlebih Dahulu...!!!'); 
           document.getElementById('dd2').focus() ;
           exit();
           }
        if(kode==''){
          alert('Kode SKPD Tidak Boleh Kosong');
          exit();
        }
          
        $(document).ready(function(){
            
            $.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>/index.php/tukd/load_data_transaksi_lpj',
                data: ({tgl1:dtgl1,tgl2:dtgl2,kdskpd:kode,sp2d:sp2d}),
                dataType:"json",
                success:function(data){                                          
                    $.each(data,function(i,n){ 
                    jns_spp   =n['jns_spp'];                                   
                    xnobukti = n['no_bukti'];                                                                                        
                    xgiat    = n['kdkegiatan']; 
                    xkdrek5  = n['kdrek5'];
                    xnmrek5  = n['nmrek5'];
                    xnilai   = n['nilai1'];
					          cnilai   = n['nilaix'];
                    		
					         var total_rinci = angka(cnilai);
					         total = total + total_rinci;
					
					$("#rektotal").attr("value",number_format(total,2,',','.'));
					$("#rektotal1").attr("value",total);
					$('#dg1').edatagrid('appendRow',{jns_spp:jns_spp,no_bukti:xnobukti,kdkegiatan:xgiat,kdrek5:xkdrek5,nmrek5:xnmrek5,nilai1:xnilai,idx:i}); 
                    });
                 }
            });
         });   
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
<div id="accordion" style="width:970px;height=970px;" >
<h3><a href="#" id="section4" onclick="javascript:$('#spp').edatagrid('reload')">List LPJ </a></h3>
<div>
 <input style="background-color:#00ff99;width:20px;border:solid 1px #000000;" disabled/>
    <b>#Sudah Disetujui & Sudah di Buat SPP </b>&nbsp;
    <input style="background-color:#33ccff;width:20px;border:solid 1px #000000;" disabled/>
    <b>#Sudah Disetujui</b>&nbsp;

			<input style="background-color:#FFF;width:20px;border:solid 1px #000000;" disabled/>
			<b>#Belum Di Setujui</b>&nbsp;    

    <p align="right"> 
            <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:section1();kosong();">Tambah</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="false" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="spp" title="List LPJ" style="width:910px;height:450px;" >  
        </table>
    </p> 
</div>

<h3><a href="#" id="section1">Input LPJ</a></h3>

   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>


 
 
 <fieldset style="width:850px;height:650px;border-color:white;border-style:hidden;border-spacing:0;padding:0;">            

<table border='0' style="font-size:11px" >
 
  <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">
 
   <td width='20%'>SKPD</td>
   <td width="80%">     
        <input id="dn" name="dn"  readonly="true" style="width:130px; border: 0; " />&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nmskpd" id="nmskpd" style="width:225px" readonly>      
        </td> 
			
</tr>
<tr>
  <td width='20%'>No SP2D</td>
  <td width='80%'><input id="sp2d" name="sp2d" style="width:230px; border: 0; " />&nbsp;&nbsp; Nilai SP2D &nbsp;&nbsp;&nbsp;&nbsp;<input class="right" type="text" name="nilsp2d" id="nilsp2d" align="right" style="width:130px" readonly></td>
</tr>
<tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">
   <td  width='20%'>No LPJ</td>
   <td width='80%'><input type="text" name="no_lpj" id="no_lpj" onclick="javascript:select();" style="width:225px" onkeypress="javascript:enter(event.keyCode,'dd');"/><input type="text" name="no_lpjx" id="no_lpjx" hidden/> </td>
</tr>
 
 
  <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"> 
   <td  width='20%'>Tanggal</td>
 <td>&nbsp;<input id="dd" name="dd" type="text" style="width:95px" onkeypress="javascript:enter(event.keyCode,'keterangan');"/></td>   
 


 </tr>
 

  
  <tr>
  
   
      <td width='20%'  style="border-right-style:hidden;border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">KETERANGAN</td>
     <td width='31%' style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"><textarea name="keterangan" id="keterangan" cols="30" rows="2" ></textarea></td>
  
  </tr>
        
   <tr style="border-bottom-style:hidden;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;"> 
  
     <td  >Tanggal Transaksi</td>  
  
     <td  >
     <input id="dd1" name="dd1" type="text" style="width:95px" />&nbsp;S/D&nbsp;<input id="dd2" name="dd2" type="text" style="width:95px"/>
     &nbsp;&nbsp;&nbsp;&nbsp;<a id="load" style="width:70px" class="easyui-linkbutton" iconCls="icon-add" plain="false"  onclick="javascript:load_data();" >Tampil</a>
     &nbsp;&nbsp;&nbsp;&nbsp;<a id="load_kosong" style="width:70px" class="easyui-linkbutton" iconCls="icon-remove" plain="false"  onclick="javascript:detail_trans_kosong();" >Kosong</a>
     </td>  
  </tr>
<tr style="border-bottom-style:1px solid black;border-spacing:0px;padding:3px 3px 3px 3px;border-collapse:collapse;">
  <td >&nbsp;&nbsp;</td>
                  
      
      <td>
                  <div>
                    
                      <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Baru</a>
                      <a id="save" class="easyui-linkbutton" iconCls="icon-save" plain="false"  onclick="javascript:simpan();">Simpan</a>
                      <a id="del"class="easyui-linkbutton" iconCls="icon-remove" plain="false" onclick="javascript:hhapus();">Hapus</a>
                      <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:section4();">Kembali</a>
                  
                  </div>
        </td>                
  </tr>

  </table>
   
        <table id="dg1" title="Input Detail LPJ" style="width:900%;height:300%;" >  
        </table>
         
        <table border='0' style="width:100%;height:5%;"> 
             <td width='34%'></td>
             <td width='35%'><input class="right" type="hidden" name="rektotal1" id="rektotal1"  style="width:140px" align="right" readonly="true" ></td>
             <td width='6%'><B>Total</B></td>
             <td width='25%'><input class="right" type="text" name="rektotal" id="rektotal"  style="width:140px" align="right" readonly="true" ></td>
        </table>

   </p>

</fieldset>     
</div>
</div>
</div> 


<?php $this->load->view('inc/jr-set.php'); ?>
</body>
</html>
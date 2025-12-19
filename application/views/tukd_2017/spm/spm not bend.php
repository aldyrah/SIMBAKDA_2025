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
    <script type="text/javascript"> 
    
    var nl           = 0;
	var tnl          = 0;
	var idx          = 0;
	var tidx         = 0;
	var oldRek       = 0;
    var rek          = 0;
    var lcstatus     = '';
    var jumlah_pajak = 0;
    var pidx         = 0;
    
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
        


        $('#cspm').combogrid({  
                panelWidth:500,  
                url: '<?php echo base_url(); ?>/index.php/tukd/pilih_spm',  
                    idField    : 'no_spm',                    
                    textField  : 'no_spm',
                    mode       : 'remote',  
                    fitColumns : true,  
                    columns:[[  
                        {field:'no_spm',title:'SPM',width:60},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:60},
                        {field:'no_spp',title:'SPP',width:60} 
                    ]],
                    onSelect:function(rowIndex,rowData){
                    kode = rowData.no_spm;
                    skpd = rowData.kd_skpd;
                    //val_ttd(skpd);
                    }   
                });
                
        

        $('#spm').edatagrid({
        		url: '<?php echo base_url(); ?>/index.php/tukd/load_spm',
                idField       : 'id',            
                rownumbers    : "true", 
                fitColumns    : "true",
                singleSelect  : "true",
                autoRowHeight : "false",
                loadMsg       : "Tunggu Sebentar....!!",
                pagination    : "true",
                nowrap        : "true",                       
                columns:[[
            	    {field:'no_spm',
            		title:'Nomor SPM',
            		width:70},
                    {field:'tgl_spm',
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
                  no_spm   = rowData.no_spm;
                  no_spp   = rowData.no_spp;
                  skpd     = rowData.kd_skpd;         
                  tgs      = rowData.tgl_spm;
                  st       =  rowData.status;
                  jns      = rowData.jns_spp;
                  nospd    = rowData.no_spd;
                  tgspp    = rowData.tgl_spp;
                  cnpwp    = rowData.npwp;
                  nbl      = rowData.bulan;
                  ckep     = rowData.keperluan;
                  bank     = rowData.bank;
                  crekan   = rowData.nmrekan;
                  cnorek   = rowData.no_rek;
                  cnmskpd  = rowData.nm_skpd;
                  getspm(no_spm,no_spp,tgs,st,jns,skpd,nospd,tgspp,cnpwp,nbl,ckep,bank,crekan,cnorek,cnmskpd);  
                  detail();
                  lcstatus = 'edit';   
                },
                onDblClickRow:function(rowIndex,rowData,st){
                    section2();   
                }
            });
            
            
            
            $('#nospp').combogrid({  
                panelWidth : 500,  
                url        : '<?php echo base_url(); ?>/index.php/tukd/nospp_2',  
                idField    : 'no_spp',                    
                textField  : 'no_spp',
                mode       : 'remote',  
                fitColumns : true,  
                columns:[[  
                        {field:'no_spp',title:'No',width:60},  
                        {field:'kd_skpd',title:'SKPD',align:'left',width:80} 
                    ]],
                     onSelect:function(rowIndex,rowData){
                        no_spp = rowData.no_spp;         
                        skpd   = rowData.kd_skpd;
                        sp     = rowData.no_spd;          
                        bl     = rowData.bulan;
                        tg     = rowData.tgl_spp;
                        jns    = rowData.jns_spp;
                        kep    = rowData.keperluan;
                        np     = rowData.npwp;
                        rekan  = rowData.nmrekan;
                        bk     = rowData.bank;
                        ning   = rowData.no_rek;
                        nm     = rowData.nm_skpd;        
                        get(no_spp,skpd,sp,tg,bl,jns,kep,np,rekan,bk,ning,nm);
                        detail();                                                                
                    }  
                });
                
                
                $('#dg').edatagrid({
                    url           : '<?php echo base_url(); ?>/index.php/tukd/select_data1',
                    autoRowHeight : "true",
                    idField       : 'id',
                    toolbar       : "#toolbar",              
                    rownumbers    : "true", 
                    fitColumns    : false,
                    singleSelect  : "true"
                    });
            
                
                $('#rekpajak').combogrid({  
                   panelWidth : 700,  
                   idField    : 'kd_rek5',  
                   textField  : 'kd_rek5',  
                   mode       : 'remote',
                   url        : '<?php echo base_url(); ?>index.php/tukd/rek_pot',  
                   columns:[[  
                       {field:'kd_rek5',title:'Kode Rekening',width:100},  
                       {field:'nm_rek5',title:'Nama Rekening',width:700}    
                   ]],  
                   onSelect:function(rowIndex,rowData){
                       $("#nmrekpajak").attr("value",rowData.nm_rek5.toUpperCase());
                   }  
                   });
                   
                   
    			$('#dgpajak').edatagrid({
    			     url            : '<?php echo base_url(); ?>/index.php/tukd/pot',
                     idField        : 'id',
                     toolbar        : "#toolbar",              
                     rownumbers     : "true", 
                     fitColumns     : false,
                     autoRowHeight  : "true",
                     singleSelect   : false,
                     columns:[[
                        {field:'id',title:'id',width:100,align:'left',hidden:'true'}, 
                        {field:'kd_rek5',title:'Rekening',width:100,align:'left'},			
    					{field:'nm_rek5',title:'Nama Rekening',width:317},
    					{field:'nilai',title:'Nilai',width:250,align:"right"},
                        {field:'hapus',title:'Hapus',width:100,align:"center",
                        formatter:function(value,rec){ 
                        return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                        }
                        }
        			]]	
        			});
   	    });

           

           $(function(){
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
					 width:350					 
					},                    
                    {field:'nilai1',
					 title:'Nilai',
					 width:170,
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
					 width:400					 
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
              

        function get(no_spp,kd_skpd,no_spd,tgl_spp,bulan,jns_spp,keperluan,npwp,rekanan,bank,rekening,nm_skpd){
            $("#nospp").attr("value",no_spp);
    		$("#nospp1").attr("value",no_spp);
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
                  
        
        function getspm(no_spm,no_spp,tgl_spm,status,jns_spp,kd_skpd,nospd,tgspp,npwp,bulan,keperluan,bank,rekanan,rekening,nm_skpd){
            $("#no_spm").attr("value",no_spm);
            $("#no_spm_hide").attr("value",no_spm);
            $("#nospp").combogrid("setValue",no_spp);
            $("#dd").datebox("setValue",tgl_spm);
            $("#jns_beban").attr("Value",jns_spp);
            $("#dn").attr("Value",kd_skpd);
            $("#sp").attr("value",nospd);   
            $("#tgl_spp").attr("value",tgspp);
            $("#npwp").attr("Value",npwp);
            $("#kebutuhan_bulan").attr("Value",bulan);
            $("#ketentuan").attr("Value",keperluan);
            $("#bank1").attr("Value",bank);
            $("#rekanan").attr("Value",rekanan);
            $("#rekening").attr("Value",rekening);
            $("#nmskpd").attr("Value",nm_skpd);
            tombol(status);                   
        }
		
        
        function kosong(){

            lcstatus = 'tambah';    
            cdate    = '<?php echo date("Y-m-d"); ?>';
            $("#no_spm").attr("value",'');
            $("#no_spm_hide").attr("value",'');

            $("#dd").datebox("setValue",cdate);
            $("#nospp").combogrid("setValue",'');       
            $("#dn").attr("value",'');
            $("#sp").attr("value",'');        
            $("#tgl_spp").attr("value",'');
            $("#kebutuhan_bulan").attr("Value",'');
            $("#ketentuan").attr("Value",'');
            $("#jns_beban").attr("Value",'');
            $("#npwp").attr("Value",'');
            $("#rekanan").attr("Value",'');
            $("#bank1").attr("Value",'');
            $("#rekening").attr("Value",'');
            $("#nmskpd").attr("Value",'');
            document.getElementById("p1").innerHTML="";
            detail1();
            $("#nospp").combogrid("clear");
            tombolnew();
            $("#totalrekpajak").attr("value",0);
            
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
        var nom=document.getElementById("no_spm").value;
        $("#cspm").combogrid("setValue",nom);
        $("#dialog-modal").dialog('open');
    } 
    
    
    function keluar(){
        $("#dialog-modal").dialog('close');
    }   
    
    
    function cari(){
     var kriteria = document.getElementById("txtcari").value; 
        $(function(){ 
            $('#spm').edatagrid({
	       url: '<?php echo base_url(); ?>/index.php/tukd/load_spm',
         queryParams:({cari:kriteria})
        });        
     });
    }
        
    
    function simpan_spm(){        
    
        var a1      = document.getElementById('no_spm').value;
        var a1_hide = document.getElementById('no_spm_hide').value;
        var b1      = $('#dd').datebox('getValue'); 
        var b       = document.getElementById('tgl_spp').value;      
        var c       = document.getElementById('jns_beban').value; 
        var d       = document.getElementById('kebutuhan_bulan').value;
        var e       = document.getElementById('ketentuan').value;
        var f       = document.getElementById('rekanan').value;
        var g       = document.getElementById('bank1').value;
        var h       = document.getElementById('npwp').value;
        var i       = document.getElementById('rekening').value;
        var j       = document.getElementById('nmskpd').value;
        var k       = document.getElementById('dn').value;
        var l       = document.getElementById('sp').value;
        var m       = document.getElementById('rekspm1').value; 
        
        if (lcstatus=='tambah') { 

            lcinsert = " ( no_spm,     tgl_spm,   no_spp,       kd_skpd,  nm_skpd,  tgl_spp,  bulan,   no_spd,  keperluan, username, last_update, status, jns_spp,  bank,     nmrekan,  no_rek,   npwp,    nilai   ) ";
            lcvalues = " ( '"+a1+"',   '"+b1+"',  '"+no_spp+"', '"+k+"',  '"+j+"',  '"+b+"',  '"+d+"', '"+l+"', '"+e+"',   '',       '',          '0',    '"+c+"',  '"+g+"',  '"+f+"',  '"+i+"',  '"+h+"', '"+m+"' ) ";           
            
            $(document).ready(function(){
                $.ajax({
                    type     : "POST",
                    url      : '<?php echo base_url(); ?>/index.php/tukd/simpan_tukd',
                    data     : ({tabel:'trhspm',kolom:lcinsert,nilai:lcvalues,cid:'no_spm',lcid:a1,tagih:no_spp}),
                    dataType : "json",
                    success  : function(data){
                        status = data;
                        if (status=='0'){
                            alert('Gagal Simpan..!!');
                            exit();
                        } else if(status=='1'){
                                  alert('Nomor SPM Sudah Terpakai...!!!,  Ganti Nomor SPM...!!!');
                                  exit();
                               } else {
                                  alert('Data Tersimpan..!!');
                                  lcstatus = 'edit';
                                  exit();
                               }
                    }
                });
            });   
           
        } else {
            
            lcquery = " UPDATE trhspm SET no_spm='"+a1+"',  tgl_spm='"+b1+"',  no_spp='"+no_spp+"', kd_skpd='"+k+"',  nm_skpd='"+j+"', tgl_spp='"+b+"',  bulan='"+d+"',   no_spd='"+l+"',  keperluan='"+e+"',  username='',  last_update='',  status='0',  jns_spp='"+c+"',  bank='"+g+"',  nmrekan='"+f+"',  no_rek='"+i+"',  npwp='"+h+"',  nilai='"+m+"' where no_spm='"+a1_hide+"'  "; 
            
            $(document).ready(function(){
            $.ajax({
                type     : "POST",
                url      : '<?php echo base_url(); ?>/index.php/tukd/update_tukd',
                data     : ({st_query:lcquery,tabel:'trhspm',cid:'no_spm',lcid:a1,lcid_h:a1_hide}),
                dataType : "json",
                success  : function(data){
                           status=data ;
                        
                        if ( status=='1' ){
                            alert('Nomor SPM Sudah Terpakai...!!!,  Ganti Nomor SPM...!!!');
                            exit();
                        }
                        
                        if ( status=='2' ){
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
            $("#no_spm_hide").attr("Value",a1);
        }
        
    
    function simpan(reke,nrek){		
		var spm = document.getElementById('no_spm').value;
		var cskpd =document.getElementById('dn').value;
        
        $(function(){      
            $.ajax({
            type: 'POST',
            data: ({cskpd:cskpd,spm:spm,kd_rek5:reke,nmrek:nrek}),
            dataType:"json",
            url:'<?php echo base_url(); ?>/index.php/tukd/pot_simpan'
         });
        });
		}
        
        
    function psimpan(reke,nrek,nilai,ket){		
		var spm = document.getElementById('no_spm').value;
		var cskpd =document.getElementById('dn').value;
        $(function(){      
            $.ajax({
            type: 'POST',
            data: ({cskpd:cskpd,spm:spm,kd_rek5:reke,nmrek:nrek,nilai:nilai,ket:ket}),
            dataType:"json",
            url:'<?php echo base_url(); ?>/index.php/tukd/potsimpan'
         });
        });
		}
     
          
    function hhapus(){				
		var spm = document.getElementById("no_spm").value;
		var urll= '<?php echo base_url(); ?>/index.php/tukd/hapus_spm';             			    
		if (spm !=''){
			var del=confirm('Anda yakin akan menghapus SPM '+spm+'  ?');
			if  (del==true){
				$(document).ready(function(){
					$.post(urll,({no:spm,spp:no_spp}),function(data){
						status = data;
					});
				});
				$('#spm').edatagrid('reload');
			}
		} 
	}
        
        
    function phapus(){				
            var spm = document.getElementById("no_spm").value;
            var rek=getSelections();                       
            var urll= '<?php echo base_url(); ?>/index.php/tukd/hapus_pot';             			    
         	if (spm !=''){
				var del=confirm('Anda yakin akan menghapus rek '+rek+'  ?');
				if  (del==true){
					$(document).ready(function(){
                    $.post(urll,({no:spm,rek:rek}),function(data){
                    status = data;
                        
                    });
                    });
				
				}
				} 
		}  
         

    function getSelections(idx){
			var ids = [];
			var rows = $('#pot').edatagrid('getSelections');
			for(var i=0;i<rows.length;i++){
				ids.push(rows[i].kd_rek5);
			}
			return ids.join(':');
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
		var spm = document.getElementById('no_spm').value;              
        $(function(){      
         $.ajax({
            type      : 'POST',
            data      : ({spm:spm}),
            url       : "<?php echo base_url(); ?>index.php/tukd/load_sum_pot",
            dataType  : "json",
            success   : function(data){ 
                $.each(data, function(i,n){
                    //$("#totalrekpajak").attr("value",number_format(n['rektotal'],2,'.',','));
                    $("#totalrekpajak").attr("value",n['rektotal']);
                });
            }
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
     
     
     function tombol(st){  
        if (st=='1'){
            $('#save').linkbutton('disable');
            $('#del').linkbutton('disable');
            $('#poto').linkbutton('disable');       
            document.getElementById("p1").innerHTML="Sudah di Buat SP2D!!";
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
     $('#poto').linkbutton('enable');     
    }
     
    
    function openWindow( url )
        {
        var no =kode.split("/").join("123456789");
		var ttd1= $('#ttd').combogrid("getValue");
		var ttd= ttd1.split(" ").join("dd");
        window.open(url+'/'+no+'/'+skpd+'/'+jns+'/'+ttd, '_blank');
        window.focus();
        }
        
    function cek(){
        var lcno = document.getElementById('no_spm').value;
            if ( lcno !='' ) {
               section3();  
               $("#totalrekpajak").attr("value",0);  
               $("#nilairekpajak").attr("value",0);  
               tampil_potongan();          
               load_sum_pot();
               $("#rekpajak").combogrid("setValue",'');
               $("#nmrekpajak").attr("value",'');
               
            } else {
                alert('Nomor SPM Tidak Boleh kosong')
                document.getElementById('no_spm').focus();
                exit();
            }
    }    
    
    
    function append_save() {
        
            $('#dgpajak').datagrid('selectAll');
            var rows  = $('#dgpajak').datagrid('getSelections');
            jgrid     = rows.length ; 
        
            var rek_pajak    = $("#rekpajak").combogrid("getValue") ;
            var nm_rek_pajak = document.getElementById("nmrekpajak").value ;
            var nilai_pajak  = document.getElementById("nilairekpajak").value ;
            var nil_pajak    = angka(nilai_pajak);
            var dinas        = document.getElementById('dn').value;
            var vnospm       = document.getElementById('no_spm').value;
            var cket         = '0' ;
            
            var jumlah_pajak = document.getElementById('totalrekpajak').value ;   
                jumlah_pajak = angka(jumlah_pajak);        
            
            if ( rek_pajak == '' ){
                alert("Isi Rekening Terlebih Dahulu...!!!");
                exit();
                }
            
            if ( nilai_pajak == 0 ){
                alert("Isi Nilai Terlebih Dahulu...!!!");
                exit();
                }
            
            pidx = jgrid + 1 ;

            $('#dgpajak').edatagrid('appendRow',{kd_rek5:rek_pajak,nm_rek5:nm_rek_pajak,nilai:nilai_pajak,id:pidx});
            $(document).ready(function(){      
                $.ajax({
                type     : 'POST',
                url      : "<?php  echo base_url(); ?>index.php/tukd/dsimpan_pot_ar",
                data     : ({cskpd:dinas,spm:vnospm,kd_rek5:rek_pajak,nmrek:nm_rek_pajak,nilai:nil_pajak,ket:cket}),
                dataType : "json"
                });
            });
            
            $("#rekpajak").combogrid("setValue",'');
            $("#nmrekpajak").attr("value",'');
            $("#nilairekpajak").attr("value",0);
            jumlah_pajak = jumlah_pajak + nil_pajak ;
            $("#totalrekpajak").attr('value',number_format(jumlah_pajak,2,'.',','));
            validate_rekening();
    
    }


    function validate_rekening() {
           
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
    
    
    function hapus_detail(){
        
        var vnospm        = document.getElementById('no_spm').value;
        var dinas         = document.getElementById('dn').value;
        
        var rows          = $('#dgpajak').edatagrid('getSelected');
        var ctotalpotspm  = document.getElementById('totalrekpajak').value ;
        
        bkdrek            = rows.kd_rek5;
        bnilai            = rows.nilai;
        
        var idx = $('#dgpajak').edatagrid('getRowIndex',rows);
        var tny = confirm('Yakin Ingin Menghapus Data, Rekening : '+bkdrek+'  Nilai :  '+bnilai+' ?');
        
        if ( tny == true ) {
            
            $('#dgpajak').datagrid('deleteRow',idx);     
            $('#dgpajak').datagrid('unselectAll');
              
             var urll = '<?php  echo base_url(); ?>index.php/tukd/dsimpan_pot_delete_ar';
             $(document).ready(function(){
             $.post(urll,({cskpd:dinas,spm:vnospm,kd_rek5:bkdrek}),function(data){
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
             
             ctotalpotspm = angka(ctotalpotspm) - angka(bnilai) ;
             $("#totalrekpajak").attr("Value",number_format(ctotalpotspm,2,'.',','));
             validate_rekening();
             }     
        }
        
        
    function tampil_potongan () {
        
            var vnospm = document.getElementById('no_spm').value ;
        
            $(function(){
			$('#dgpajak').edatagrid({
				url: '<?php echo base_url(); ?>/index.php/tukd/pot',
                queryParams    : ({ spm:vnospm }),
                idField       : 'id',
                toolbar       : "#toolbar",              
                rownumbers    : "true", 
                fitColumns    : false,
                autoRowHeight : "false",
                singleSelect  : "true",
                nowrap        : "true",
      			columns       :
                     [[
                        {field:'id',title:'id',width:100,align:'left',hidden:'true'}, 
                        {field:'kd_rek5',title:'Rekening',width:100,align:'left'},			
    					{field:'nm_rek5',title:'Nama Rekening',width:317},
    					{field:'nilai',title:'Nilai',width:250,align:"right"},
                        {field:'hapus',title:'Hapus',width:100,align:"center",
                        formatter:function(value,rec){ 
                        return '<img src="<?php echo base_url(); ?>/assets/images/icon/edit_remove.png" onclick="javascript:hapus_detail();" />';
                        }
                        }
        			]]	
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
<div id="accordion">
<h3><a href="#" id="section1" onclick="javascript:$('#spm').edatagrid('reload')">List SPM</a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();section2();">Tambah</a>
        <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a>               
        <a class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="javascript:cari();">Cari</a>
        <input type="text" value="" id="txtcari"/>
        <table id="spm" title="List SPM" style="width:870px;height:450px;" >  
        </table>
    </p> 
    </div>

<h3><a href="#" id="section2" onclick="javascript:$('#dg').edatagrid('reload')" >Input SPM</a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>

<fieldset style="width:850px;height:850px;border-color:white;border-style:hidden;border-spacing:0;padding:0;">            
<table border='1' style="font-size:11px" >

 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >&nbsp;</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
 </tr>
 
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >No SPM</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;<input type="text" name="no_spm" id="no_spm" onclick="javascript:select();"  style="width:200px;"/><input type="hidden" name="no_spm_hide" id="no_spm_hide" onclick="javascript:select();"  style="width:200px;"/></td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SPM </td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;&nbsp;<input id="dd" name="dd" type="text" style="width:100px;" /></td>
 </tr>
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;" >   
   <td width="8%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No SPP</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;<input id="nospp" name="nospp" style="width:200px;" />
     <input type="hidden" name="nospp1" id="nospp1" /></td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Tgl SPP </td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;&nbsp;<input id="tgl_spp" name="tgl_spp" type="text" readonly="true" style="width:100px;" /></td>   
    </tr>
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">SKPD</td>
   <td width="53%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;" >     
      &nbsp;<input id="dn" name="dn" style="width:200px" readonly="true"/></td> 
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bulan</td>
   <td width="31%" style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;" ><select  name="kebutuhan_bulan" id="kebutuhan_bulan" style="width:200px;" >
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
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><textarea name="nmskpd" id="nmskpd" cols="40" rows="1" style="border: 0;"  readonly="true"></textarea></td>
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Keperluan</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><textarea name="ketentuan" id="ketentuan" cols="30" rows="1" readonly="true"></textarea></td>
 </tr>
 
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">No SPD</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;<input id="sp" name="sp" style="width:200px" readonly="true"/></td>
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekanan</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><textarea id="rekanan" name="rekanan" cols="30" rows="1" readonly="true" > </textarea></td>
 </tr>
 
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Beban</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;"><select name="jns_beban" id="jns_beban" style="width:200px;" >
     <option value="">...Pilih Jenis Beban... </option>
     <option value="1">UP</option>
     <option value="2">GU</option>
     <option value="3">TU</option>
     <option value="4">LS GAJI</option>
     <option value="5">LS PPKD</option>
     <option value="6">LS Barang Jasa</option>
   </select></td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Bank</td>
   <td style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;"><?php
								  		$bank1="select * from ms_bank ";
                                        $pagingquery1 = $bank1; ;
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
 <tr style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">NPWP</td>
   <td width='53%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">&nbsp;<input type="text" name="npwp" id="npwp" value="" style="width:200px;"/></td>
   <td width='8%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style:hidden;">Rekening</td>
   <td width='31%' style="border-bottom:hidden;border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;<input type="text" name="rekening" id="rekening"  value="" style="width:200px;" /></td>
 </tr>       
 
            
            
             <tr style="border-spacing: 3px;padding:3px 3px 3px 3px;">
               <td style="border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style: hidden;" >&nbsp;</td>
               <td style="border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style: hidden;">&nbsp;</td>
               <td style="border-spacing: 3px;padding:3px 3px 3px 3px;border-right-style: hidden;">&nbsp;</td>
               <td style="border-spacing: 3px;padding:3px 3px 3px 3px;">&nbsp;</td>
             </tr>
             
             <tr style="border-bottom:black; border-spacing: 3px;padding:3px 3px 3px 3px;">
                <td colspan="4" align="right" style="border-bottom:black; border-spacing: 3px;padding:3px 3px 3px 3px;">
                <a id="l"  class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:kosong();">Baru</a>
                <a id="save" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:simpan_spm();">Simpan</a>
                <a id="del" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hhapus();javascript:section1();">Hapus</a>
                <a id="poto" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="javascript:cek();">Potongan</a>
                <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section1();">Kembali</a>
                <a class="easyui-linkbutton" iconCls="icon-print" plain="true" onclick="javascript:cetak();">cetak</a></td>                
            </tr>
  
            
    </table>
    <table id="dg" title=" Detail SPM" style="width:850%;height:250%;">  
    </table>
        
        <!--
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Total</B>&nbsp;&nbsp;<input class="right" type="text" name="rekspm" id="rekspm"  style="width:140px" align="right" readonly="true" >
        <input class="right" type="hidden" name="rekspm1" id="rekspm1"  style="width:100px" align="right" readonly="true" >
        -->
        
        <table border='0' >
            
            <tr>
                <td width='400px'></td>
                <td width='220px'></td>
                <td width='240px'></td>
            </tr>
            
            <tr>
                <td></td>
                <td align='right'><B>Total</B></td>
                <td align="right"><input class="right" type="text" name="rekspm" id="rekspm"  style="width:200px" align="right" readonly="true" >
                    <input class="right" type="hidden" name="rekspm1" id="rekspm1"  style="width:100px" align="right" readonly="true" >
                </td>
            </tr>
        </table>
    </p>
    </fieldset>
    </div>
    
<h3><a href="#" id="section3" >Potongan</a></h3>

    <div>
    <fieldset>
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
       
       <fieldset>
       <table border='0' style="font-size:11px"> 
           
           <tr>
                <td>Rekening Potongan</td>
                <td>:</td>
                <td><input type="text" id="rekpajak"   name="rekpajak" style="width:200px;"/></td>
                <td><input type="text" id="nmrekpajak" name="nmrekpajak" style="width:400px;border:0px;"/></td>
           </tr>
           <tr>
                <td align="left">Nilai</td>
                <td>:</td>
                <td><input type="text" id="nilairekpajak" name="nilairekpajak" style="width:200px;text-align:right;" onkeypress="return(currencyFormat(this,',','.',event))"/></td>
                <td></td>
           </tr>
           <tr>
             <td colspan="4" align="center" > 
                 <a class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:append_save();" >Simpan</a>
                 <a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:section2();" >Kembali</a>
             </td>
           </tr>
       </table>
       </fieldset>
       
      &nbsp;&nbsp; 
       
       <table id="dgpajak" title="List Potongan" style="width:850px;height:300px;">  
       </table>   
       
       <table border='0' style="font-size:11px;width:850px;height:30px;"> 
           <tr>
                <td width='50%'></td>
                <td width='20%' align="right">Total</td>
                <td width='30%'><input type="text" id="totalrekpajak" name="totalrekpajak" style="width:250px;text-align:right;"/></td>
           </tr>
       </table>
    </fieldset>   
    </div>
</div>
</div> 

<div id="dialog-modal" title="CETAK SPM">
    <p class="validateTips">SILAHKAN PILIH SPM</p> 
    <fieldset>
    <table>

        <tr>
            <td width="110px">NO SPM:</td>
            <td><input id="cspm" name="cspm" style="width: 170px;" /></td>
        </tr>
        <tr>
            <td width="110px">Penandatangan:</td>
            <td><input id="ttd" name="ttd" style="width: 170px;" /></td>
        </tr>
       
    </table>  
    </fieldset>
    <a href="<?php echo site_url(); ?>/tukd/cetak_spm" class="easyui-linkbutton" plain="true" onclick="javascript:openWindow(this.href);return false;">Cetak</a>
	<a class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:keluar();">Keluar</a>  
</div>
</body>
</html>
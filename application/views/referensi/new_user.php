

   
    <script src="<?php echo base_url(); ?>easyui/sweetalert/lib/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>easyui/sweetalert/lib/sweet-alert.css">
    <script type="text/javascript">
  
					 
	var idx      = 0;
	var lcstatus ='';
	var cek      =1;
	var idus     ='';
    var tt		='';
	var st		='';
    $(document).ready(function() {
            $("#accordion").accordion();            
        });    
     
     $(function(){ 
		$('#dg').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/master/load_new_user',
			idField:'id',            
			rownumbers:"true", 
			fitColumns:"true",
			singleSelect:"true",
			autoRowHeight:"false",
			pagination:"true",
			nowrap:"true",                       
			columns:[[
				{field:'id_user',title:'ID',width:10,align:"center"},
				{field:'username',title:'User Name',width:60,align:"justify"},
				{field:'password',title:'ap',width:10,align:"center",hidden:"true"},
				{field:'aplikasi',title:'ap',width:10,align:"center",hidden:"true"},
				{field:'nickname',title:'Nickname',width:80,align:"justify"},
				{field:'kdskpd',title:'Kode SKPD',width:30, align:"right"},
				{field:'nmskpd',title:'Nama SKPD',width:100, align:"left"}
			]],
			onSelect:function(rowIndex,rowData){
				idus=rowData.id_user;
				user=rowData.username;
				pass=rowData.password;
				ap=rowData.aplikasi;
				nick=rowData.nickname;
				skpd=rowData.kdskpd;
				nm=rowData.nmskpd;
				get(idus,user,pass,ap,nick,skpd,nm);
			},
			onDblClickRow:function(rowIndex,rowData){ 
				idus=rowData.id_user;
				lcstatus='edit';
				load_detail(idus);
				section2();
			}
		});
    
       
        
        $('#dg1').edatagrid({  
            toolbar:'#toolbar',
            rownumbers:"true",            
            singleSelect:"true",
            autoRowHeight:"false",
			pagination:"true",
            nowrap:"true",
            columns:[[
				{field:'idx',title:'ID',width:150,align:"center"},
				{field:'title',title:'Menu',width:580},
				{field:'status',title:'Status',align:'center',width:150,
				editor:{type:'combobox',
						options:{ valueField:'status',
								  textField:'status',
								  panelwidth:100,	
								  panelheigth:10,	
								  url :'<?php echo base_url(); ?>/index.php/master/yatidak',
								  required:false,
									onSelect:function(rowisi){
										st=rowisi.status;
										simpanx(idx,tt,st); 
									}
								}
						}			
				},
			]],
			onAfterEdit:function(rowIndex, rowData, changes){
				idx=rowData.idx;
				tt = rowData.title;
				st = rowData.status;
				simpanx(idx,tt,st); 
			},
			onSelect:function(rowIndex,rowData){			
				idx=rowData.idx;
				tt = rowData.title;
				st = rowData.status;
			}
        
        });
		
		$('#skpd').combogrid({  
			panelWidth:700,  
			url: '<?php echo base_url(); ?>/index.php/master/ambil_msskpd2',  
				idField:'kd_skpd',                    
				textField:'kd_skpd',
				mode:'remote',  
				fitColumns:true,  
				columns:[[  
               {field:'kd_skpd',title:'Kode SKPD',width:100},  
               {field:'nm_skpd',title:'Nama SKPD',width:250},
               {field:'kd_lokasi',title:'Kode Unit',width:100},  
               {field:'nm_lokasi',title:'Nama Unit',width:250}    
            ]],
				onSelect:function(rowIndex,rowData){
				   kdskpd=rowData.kd_skpd;
				   nmskpd=rowData.nm_skpd;
				   kdlokasi=rowData.kd_lokasi;
				   nmlokasi=rowData.nm_lokasi;
				   $("#nmskpd").attr("value",nmskpd);
				   $("#lokasi").attr("value",kdlokasi);
				   $("#nmlokasi").attr("value",nmlokasi);
				
				}   
         });


	});	  
    
	function simpanx(cid,ctt,sta){
		var ids =  document.getElementById('iduser').value;	
		$(document).ready(function(){
			$.ajax({
				type: "POST",
				url: '<?php echo base_url(); ?>/index.php/master/simpan_otorisasi_new',
				data: ({idx:cid,tt:ctt,st:sta,vids:ids}),
				dataType:"json",
				 success:function(data){
					$('#dg1').datagrid('reload'); 
				}
			});
		});                                               
    } 

	 function kembali(){
         $(document).ready(function(){    
             $('#section1').click(); 
			 $('#dg').datagrid('reload');
         });
		 kosong();
    }

     function section2(){
         $(document).ready(function(){                
             $('#section2').click(); 
             document.getElementById("username").focus();  	  
         });    
     }
    
    function load_detail(ww){
		$('#dg1').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/master/load_otorisasi_new',
            queryParams:({idus:ww})
		});
     }
    
	function cari(z){
		$(function(){ 
		 $('#dg').edatagrid({
			url: '<?php echo base_url(); ?>/index.php/master/load_new_user',
			queryParams:({cari:z})
			});        
		 });
    }
   
   function get(id,user,pass,ap,nick,skpd,nm){
		$("#iduser").attr("value",id);
		$("#username").attr("value",user);
		$("#password").attr("value",pass);
		$("#ap").attr("value",ap);
		$("#nickname").attr("value",nick);
		$("#skpd").combogrid("setValue",skpd);
		$("#nmskpd").attr("value",nmskpd);
   }
	
	function kosong(){
		$('#save').linkbutton('enable');
		$("#iduser").attr("value",'');
		$("#username").attr("value",'');
		$("#password").attr("value",'');
		$("#ap").attr("value",'');
		$("#nickname").attr("value",'');
		$("#skpd").combogrid("setValue",'');
		$("#lokasi").attr("value",'');
		$("#nmskpd").attr("value",'');
		$("#nmlokasi").attr("value",'');
		$("#opt").attr("value",'');	
		$('#dg1').datagrid('loadData', {"total":0,"rows":[]});
		lcstatus='tambah';
	}
	
	function cari_otori(x){
		var id=document.getElementById("iduser").value;
		$(function(){
		 $('#dg1').edatagrid({
			loadMsg:"Tunggu Sebentar....!!",
			url: '<?php echo base_url(); ?>/index.php/master/load_otorisasi_new',
			queryParams:({idus:id,cari:x})
			});        
		 });
	
	}
	
	function simpan(){
		var cidus=document.getElementById("iduser").value;
		var cuser=document.getElementById("username").value;
		var cpass=document.getElementById("password").value;
		var capl  =document.getElementById("ap").value;
		var cnick=document.getElementById("nickname").value;
		var copt=document.getElementById("opt").value;
		var cskpd= $("#skpd").combogrid("getValue");
		var lokasi=document.getElementById("lokasi").value;
		if(cuser == ''){
			swal("Oops...", "User Name Can't be Empty!", "error");
			exit();
		}
		if(cpass == ''){
			swal("Oops...", "Password Can't be Empty!", "error");
			exit();
		}
		if(cnick == ''){
			swal("Oops...", "Nick Name Can't be Empty!", "error");
			exit();
		}
		if(capl == ''){
			swal("Oops...", "Otorisasi Can't be Empty!", "error");
			exit();
		}
		/*if(cskpd == ''){
			swal("Oops...", "SKPD Can't be Empty!", "error");
			exit();
		}*/

		if(lcstatus=='tambah'){
			$('#save').linkbutton('disable');
			var urll = '<?php echo base_url(); ?>index.php/master/simpan_new';
			$(document).ready(function(){
				$.ajax({url:urll,
					 dataType:'json',
					 type: "POST",    
					 data:({user:cuser,pass:cpass,apl:capl,nick:cnick,skpd:cskpd,opt:copt,lokasi:lokasi}),
					 success:function(data){
						status = data.pesan;
						if (status=='1'){
							swal("Saved!", "Your imaginary file has been saved.", "success"); 
							kembali();
						} else {
							swal("Oops...", "Something went wrong!", "error");
						}        
					 }
					 
				});           
			});
		}else{
			var urlx = '<?php echo base_url(); ?>index.php/master/update_new';
			$(document).ready(function(){
				$.ajax({url:urlx,
					 dataType:'json',
					 type: "POST",    
					 data:({idus:cidus,user:cuser,pass:cpass,apl:capl,nick:cnick,skpd:cskpd,opt:copt,lokasi:lokasi}),
					 success:function(data){
						status = data.pesan;
						if (status=='1'){
							swal("Updated!", "Your imaginary file has been updated.", "success"); 
							kembali();
						} else {
							swal("Oops...", "Something went wrong!", "error");
						}        
					 }
					 
				});           
			});
		}
	
	}

	

	function hapus(){
		var ids =  document.getElementById('iduser').value;	
		var user =  document.getElementById('username').value;	
		var urll = '<?php echo base_url(); ?>index.php/master/hapus_new';
		swal({
		  title: "Are you sure?",
		  text: "You will be delete id "+ids+" with name "+user+" !!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  cancelButtonText: "No, cancel plx!",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
			
		  if (isConfirm) {

			$(document).ready(function(){
			$.ajax({url:urll,
					 dataType:'json',
					 type: "POST",    
					 data:({idus:ids}),
					 success:function(data){
							status = data.pesan;
							if (status=='1'){

								swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
								kembali();
							} else {
								swal("Oops...", "Something went wrong!", "error");
							}        
					 }
					 
					});           
			});
		  } else {
				swal("Cancelled", "Your imaginary file is safe :)", "error");
		  }
		});                                               
	}
	
	

	function sampling(){
		var ap=document.getElementById('ap').value;	
		if(ap==01){
			$("#opt").attr("value",'2');	
			//load_detail(133);
		}else if(ap==02){
			$("#opt").attr("value",'3');
			//load_detail(123);
		}else{
			$("#opt").attr("value",'');
			$('#dg1').datagrid('loadData', {"total":0,"rows":[]});
		}

	}
    </script>

<!-- //</head> -->
<body>



<div id="content">    
<div id="accordion">
<h3><a href="#" id="section1"><i>List USER</i></a></h3>
    <div>
    <p align="right">         
        <a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();section2();">Tambah</a>               
        <a plain="false">Cari</a>
        <input id="txtcari" class="easyui-searchbox" data-options="prompt:'Please Input Value',	searcher:function(value,name){cari(value)}" style="width:190px"/>
        <table id="dg" title="List USER" style="width:915px;height:470px;" >  
        </table>                          
    </p> 
    </div>   

<h3><a href="#" id="section2"><i>USER & OTORI</i></a></h3>
   <div  style="height: 350px;">
   <p id="p1" style="font-size: x-large;color: red;"></p>
   <p>       
		<fieldset>
        <table align="center" border='0' style="width:850px;">
        
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td colspan="5" style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"><input type="text" id="iduser"  style="width: 200px;" hidden/></td>
            </tr>                        

            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;width:100px;"><i>USER NAME</i></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">:</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="username"  style="width: 200px;"/></td>  
				 <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden; width:100px;"><i>PASSWORD</i></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">:</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="password"  style="width: 200px;"/></td>   
            </tr> 
			<tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;width:100px;"><i>NICKNAME</i></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">:</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="nickname"  style="width: 200px;"/></td> 
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;width:100px;"><i>OTORISASI</i></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">:</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;"><select id="ap"  style="width: 150px;" onchange="javascript:sampling();"/>
				<option value="" selected>...Pilih Otorisasi...</option>
				<option value="01">ADMIN</option>
				<option value="02">OPERATOR</option>
				</select>&nbsp;<i>Sampling</i>&nbsp;&nbsp;<input type="text" id="opt"  style="width: 30px;"/></td>
				</td> 
            </tr>  
			<tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;width:100px;"><i>SKPD</i></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">:</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="skpd"  style="width: 200px;"/></td>  
				 <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden; width:100px;" colspan="3"><i><input type="text" id="nmskpd"  style="border-bottom-style:hidden;border-right-style:hidden;width:450px;" readonly/></i></td>
            </tr> 
            <tr style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;width:100px;"><i>UNIT</i></td>
				<td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">:</td>
                <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden;">&nbsp;<input type="text" id="lokasi"  style="width: 200px;" readonly/></td>  
				 <td style="border-bottom-style:hidden;padding:3px;border-spacing:5px 5px 5px 5px;border-right-style:hidden; width:100px;" colspan="3"><i><input type="text" id="nmlokasi"  style="border-bottom-style:hidden;border-right-style:hidden;width:450px;" readonly/></i></td>
            </tr> 
        </table>      
		</fieldset>
         <table align="right">
			 <tr style="padding:3px;border-spacing:5px 5px 5px 5px;">
                <td style="padding:3px;border-spacing:5px 5px 5px 5px;border-bottom-style:hidden;" colspan="5" align="right"><a class="easyui-linkbutton" iconCls="icon-add" plain="false" onclick="javascript:kosong();">Tambah</a>
                    <a class="easyui-linkbutton" id="save" iconCls="icon-save" plain="false" onclick="javascript:simpan();">Simpan</a>
		            <a class="easyui-linkbutton" id="hapus_advise" iconCls="icon-remove" plain="false" onclick="javascript:hapus();">Hapus</a>
  		            <a class="easyui-linkbutton" iconCls="icon-undo" plain="false" onclick="javascript:kembali();">Kembali</a>                                   
                </td>
            </tr>
		 </table>
        <table id="dg1" title="List Otori" style="width:915px;height:355px;" >  
        </table>  
        
        <div id="toolbar" align="right">
			<tr>
				<td align="left" width="100px">Cari&nbsp;&nbsp
					<input id="txt_std" class="easyui-searchbox" data-options="prompt:'Please Input Value',	searcher:function(value,name){cari_otori(value)}" style="width:190px"/>
				</td>
			</tr>
        </div>
                
   </p>
   </div>
   
</div>
</div>

</body>

<!-- </html> -->
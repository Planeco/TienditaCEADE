<?php
$ar=array(array('Marco Antonio ','Romero Millan ','gerentecomercial@planetucc.com')
//,array('Nelly ','Salas','atenciontelefonica02@planetucc.com')
//,array('Ulises ','Trinidad','ulises@planetucc.com')
/*,array('Mario Antonio ','Lanz L&oacute;pez','mario@planetucc.com')
,array('Luis Enrique ','Leyva Monta&ntilde;o','luis@planetucc.com')
,array('Alejandro ','Moreno Linares','alejandro@planetucc.com')
,array('Oscar ','Rivera Romo','oscar@planetucc.com')*/
);
$int=1;
$ar=array(array('Root','root2018','root','1','root@tiendita'),
    array('Ana Laura','ana2018','ana','1','anajuarez@ceade.mx'),
    array('Aidee','aidee2018','aidee','1','aideelazcano@ceade.mx'),
    array('Josué','josue2018','josueenriquez','1','josue@insha.com.mx'),
    array('Jorge','jorge2018','jorge','1','jorgelara@insha.com.mx'),
    array('Alexander','alex2018','alexander','1','alexandermayorga@insha.com.mx'),
    array('Ulises','ulises2018','ulises','1','ulisesmoreno@insha.com.mx'),
    array('José Antonio','antonio2018','antonio','1','antoniopacheco@insha.com.mx'),
    array('José Luis','jl2018','jl','1','joseluistorres@insha.com.mx'),
    array('Félix','felix2018','felix','1','felixortiz@insha.com.mx'),
);
foreach ($ar as $v=>$vendedor){
	srand($int);
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
$passwordSalt = hash('sha512', $vendedor[1]. $random_salt);
$sql= "INSERT INTO usuario VALUES (NULL, '".$vendedor[0]."');";
	$sql2="INSERT INTO `login_user` (`id_login`, `id_usuario`, `user_name`, `password`, `salt`, `id_rol`,email) 
			VALUES (NULL, '$int', '".$vendedor[2]."', '".$passwordSalt."', '".$random_salt."', '".$vendedor[3]."', '".$vendedor[4]."');";
$int++;
	echo $sql.'<br /> <br />'.$sql2.'<br /> <br /> <br />';
}
echo srand(5);
echo rand();


/*
 INSERT INTO `registertmp` (`idRegisterTmp`, `full_name`, `full_lastname`, `empresaTxt`, `phone`, `idCountry`, `state`, `city`, `addressTxt`, 
 `cpTxt`, `sameDir`, `full_fiscalname`, `emailfiscal`, `phonefiscal`, `addressFiscalTxt`, `cpFiscalTxt`, `idCountryFiscal`, `stateFiscal`, 
 `cityFiscal`, `vatFiscal`, `domainName`, `password`, `crmLanguage`, `invoiceLanguage`, `idAmadeoOptions`, `nbrUsers`, `orderTotal`, `fechaAlta`,
  `estatusPago`, `proveedorPago`, `email`, `agentId`, `estatus`, `type`, `idAccount`) VALUES (NULL, 'Gilberto ', 'Hernández ', '', '', '0', '', '', '', '0', '0', 'Gilberto ', 'gilbertohernandez@sypi.com.mx', '', '', '0', '0', '', '', '', 'gilbertohernandez@sypi.com.mx','gilbertohernandez@sypi.com.mx_2017', '', '', '', '0', '0', NULL, 'pendiente', '', 'gilbertohernandez@sypi.com.mx', '22253', 'pendiente', 'trial', '');

INSERT INTO `login_user` (`id_login`, `id_usuario`, `user_name`, `password`, `salt`, `first_name`, `last_name`, `id_rol`,email) 
VALUES (NULL, '282', 'gilbertohernandez@sypi.com.mx', '1c6004ed60aa95236eb00d46a437ddafb4f01b6eb0f56ff87df00a19cde1cc6bf2b79ee54d3500483e4bb2c77fbd3d71a61c437dfa76a12c3d501d466971e02d', 
'e039969ca462fb30a1b274de92e9a0f1747a79167963cd6448d81c31ecf5f206e6aded3f120602080f3d779b23c02ec35f8424022c73885540b97fd86f3b99e6', 
'Gilberto ', 'Hernández ', '1', '   ');

 *
 * */?>
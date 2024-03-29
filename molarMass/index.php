<?php require_once('http://downardo.com/template/head.php'); ?>

 <script language="javascript">
atom=new Array();
atom["H"]= 1.00794;
atom["He"]= 4.0026;
atom["Li"]= 6.941;
atom["Be"]= 9.01218;
atom["B"]= 10.811;
atom["C"]= 12.011;
atom["N"]= 14.0067;
atom["O"]= 15.9994;
atom["F"]= 18.9984;
atom["Ne"]= 20.1797;
atom["Na"]= 22.98977;
atom["Mg"]= 24.305;
atom["Al"]=26.98154;
atom["Si"]= 28.0855;
atom["P"]= 30.97376;
atom["S"]= 32.066;
atom["Cl"]= 35.4527;
atom["Ar"]= 39.948;
atom["K"]= 39.0983;
atom["Ca"]= 40.078;
atom["Sc"]= 44.9559;
atom["Ti"]= 47.88;
atom["V"]= 50.9415;
atom["Cr"]= 51.996;
atom["Mn"]= 54.938;
atom["Fe"]= 55.847;
atom["Co"]= 58.9332;
atom["Ni"]= 58.6934;
atom["Cu"]= 63.546;
atom["Zn"]= 65.39;
atom["Ga"]= 69.723;
atom["Ge"]= 72.61;
atom["As"]= 74.9216;
atom["Se"]= 78.96;
atom["Br"]= 79.904;
atom["Kr"]= 83.8;
atom["Rb"]= 85.4678;
atom["Sr"]= 87.62;
atom["Y"]= 88.9059;
atom["Zr"]= 91.224;
atom["Nb"]= 92.9064;
atom["Mo"]= 95.94;
atom["Tc"]= 98;
atom["Ru"]= 101.07;
atom["Rh"]= 102.9055;
atom["Pd"]= 106.42;
atom["Ag"]= 107.868;
atom["Cd"]= 112.41;
atom["In"]= 114.82;
atom["Sn"]= 118.71;
atom["Sb"]= 121.757;
atom["Te"]= 127.6;
atom["I"]= 126.9045;
atom["Xe"]= 131.29;
atom["Cs"]= 132.9054;
atom["Ba"]= 137.33;
atom["La"]= 138.9055;
atom["Hf"]= 178.49;
atom["Ta"]= 180.9479;
atom["W"]= 183.85;
atom["Re"]= 186.207;
atom["Os"]= 190.2;
atom["Ir"]= 192.22;
atom["Pt"]= 195.08;
atom["Au"]= 196.9665;
atom["Hg"]= 200.59;
atom["Tl"]= 204.383;
atom["Pb"]= 207.2;
atom["Bi"]= 208.9804;
atom["Po"]= 209;
atom["At"]= 210;
atom["Rn"]= 222;
atom["Fr"]= 223;
atom["Ra"]= 226.0254;
atom["Ac"]= 227;
atom["Rf"]= 261;
atom["Db"]= 262;
atom["Sg"]= 263;
atom["Bh"]= 262;
atom["Hs"]= 265;
atom["Mt"]= 266;
atom["Uun"]= 269;
atom["Uuu"]= 272;
atom["Uub"]= 277;
atom["Ce"]= 140.12;
atom["Pr"]= 140.9077;
atom["Nd"]= 144.24;
atom["Pm"]= 145;
atom["Sm"]= 150.36;
atom["Eu"]= 151.965;
atom["Gd"]= 157.25;
atom["Tb"]= 158.9253;
atom["Dy"]= 162.5;
atom["Ho"]= 164.9303;
atom["Er"]= 167.26;
atom["Tm"]= 168.9342;
atom["Yb"]= 173.04;
atom["Lu"]= 174.967;
atom["Th"]= 232.0381;
atom["Pa"]= 231.0359;
atom["U"]= 238.029;
atom["Np"]= 237.0482;
atom["Pu"]= 244;
atom["Am"]= 243;
atom["Cm"]= 247;
atom["Bk"]= 247;
atom["Cf"]= 251;
atom["Es"]= 252;
atom["Fm"]= 257;
atom["Md"]= 258;
atom["No"]= 259;
atom["Lr"]= 262;
uppercase="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
lowercase="abcdefghijklmnopqrstuvwxyz";
number="0123456789";
function calculate(formula) {
total=new Array(); level=0; total[0]=0; i=0; mass=0; name=''; percision=8;
elmass=new Array();
for (i=0; i<elmass.length;i++) {
elmass[i]=null;
}
elmass[0]=new Array();
for (i=0; i<elmass[0].length;i++) {
elmass[0][i]=0;
}
i=0;
while (formula.charAt(i)!="") {
if ((uppercase+lowercase+number+"()").indexOf(formula.charAt(i))==-1)
i++;
while (formula.charAt(i)=="(") {
level++;
i++;
total[level]=0;
elmass[level]=new Array();
for (h=0; i<elmass[level].length;h++) {
elmass[level][i]=0;
}
}
if (formula.charAt(i)==")") {
mass=total[level];
name='';
level--;
}
else if (uppercase.indexOf(formula.charAt(i))!=-1) {
name=formula.charAt(i);
while (lowercase.indexOf(formula.charAt(i+1))!=-1 && formula.charAt(i+1)!="")
name+=formula.charAt(++i);
mass=atom[name];
massStr=mass+"";
if (massStr.indexOf(".")!=-1)
masspercis=(massStr.substring(massStr.indexOf(".")+1,massStr.length)).length;
else
masspercis=0;
percision=(percision==8 || percision>masspercis)?masspercis:percision;
}
var amount="";
while (number.indexOf(formula.charAt(i+1))!=-1 && formula.charAt(i+1)!="")
amount+=formula.charAt(++i);
if (amount=="") amount="1";
total[level]+=mass*parseInt(amount);
if (name=="") {
for (ele in elmass[level+1]) {
totalnumber=parseInt(elmass[level+1][ele])*amount
if (elmass[level][ele]==null)
elmass[level][ele]=totalnumber;
else
elmass[level][ele]=totalnumber+parseInt(elmass[level][ele]);
}
}else {
if (elmass[level][name]==null)
elmass[level][name]=amount;
else
elmass[level][name]=parseInt(elmass[level][name])+parseInt(amount);
}
i++;
}
weight=rounded(total[0],percision);
previous=document.forms[1].elements[0].value;
document.forms[1].elements[0].value=document.forms[0].elements[0].value+":"+newline();
for (ele in elmass[0]) {
eltotal=eval(elmass[0][ele]*atom[ele]);
document.forms[1].elements[0].value+=elmass[0][ele]+" "+ele+" * "+atom[ele]+" = "+eltotal+" ("+rounded(eltotal/total[0]*100,percision)+"% of mass)"+newline();
}
document.forms[1].elements[0].value+=""+newline()+previous;
document.forms[1].elements[0].value+= "Total: "+weight+" g/mol"+newline();
document.forms[1].elements[0].value+=""+newline()+previous;
document.forms[0].elements[0].value='';
document.forms[0].elements[0].focus();
}

function newline(){
	return (navigator.appName.substring(0,9)=="Microsoft")?'\r':'\n';
}

function rounded(number,percision){
	return Math.round(number*Math.pow(10,percision))/Math.pow(10,percision);
}
  </script>
<center>
<h2>Molar-Mass-Calculator</h2>
<br/>
<br/>
<form action="javascript:" onsubmit="document.forms[1].elements[0].value=''; calculate(document.forms[0].elements[0].value)"><input placeholder="H2SO4" type="text"><input value="Calculate" onclick=" document.forms[1].elements[0].value=''; calculate(document.forms[0].elements[0].value)" type="button"><input onclick="document.forms[1].elements[0].value=''" value="Clear" type="button"></form>

<form> <textarea cols="60" rows="20" style="width: 60em; height: 20em;"></textarea></form>
</center>

<?php require_once('http://downardo.com/template/footer.php'); ?>
var variableslide=new Array()

//variableslide[x]=["path to image", "OPTIONAL link for image", "OPTIONAL text description (supports HTML tags)"]

variableslide[3]=['templates/clasic/img/banner/ro/gdvteaser.png', 'http://www.sv1.metin2zone.ro', '']
variableslide[0]=['templates/clasic/img/banner/ro/gdvteaser1.png', 'http://www.sv1.metin2zone.ro', '']
variableslide[1]=['templates/clasic/img/banner/ro/gdvteaser2.png', 'http://www.sv1.metin2zone.ro', '']
variableslide[2]=['templates/clasic/img/banner/ro/gdvteaser3.png', 'http://www.sv1.metin2zone.ro', '']

//configure the below 3 variables to set the dimension/background color of the slideshow

var slidewidth='480px' //set to width of LARGEST image in your slideshow
var slideheight='147px' //set to height of LARGEST iamge in your slideshow, plus any text description
var slidebgcolor='transparent'

//configure the below variable to determine the delay between image rotations (in miliseconds)
var slidedelay=10000

////Do not edit pass this line////////////////

var ie=document.all
var dom=document.getElementById

for (i=0;i<variableslide.length;i++){
var cacheimage=new Image()
cacheimage.src=variableslide[i][0]
}

var currentslide=0

function rotateimages(){
contentcontainer='<center>'
if (variableslide[currentslide][1]!="")
contentcontainer+='<a href="'+variableslide[currentslide][1]+'">'
contentcontainer+='<img src="'+variableslide[currentslide][0]+'" border="0" vspace="3">'
if (variableslide[currentslide][1]!="")
contentcontainer+='</a>'
contentcontainer+='</center>'
if (variableslide[currentslide][2]!="")
contentcontainer+=variableslide[currentslide][2]

if (document.layers){
crossrotateobj.document.write(contentcontainer)
crossrotateobj.document.close()
}
else if (ie||dom)
crossrotateobj.innerHTML=contentcontainer
if (currentslide==variableslide.length-1) currentslide=0
else currentslide++
setTimeout("rotateimages()",slidedelay)
}

if (ie||dom)
document.write('<div id="slidedom" style="width:'+slidewidth+';height:'+slideheight+'; background-color:'+slidebgcolor+'"></div>')

function start_slider(){
crossrotateobj=dom? document.getElementById("slidedom") : ie? document.all.slidedom : document.slidensmain.document.slidenssub
if (document.layers)
document.slidensmain.visibility="show"
rotateimages()
}

if (ie||dom)
start_slider()
else if (document.layers)
window.onload=start_slider

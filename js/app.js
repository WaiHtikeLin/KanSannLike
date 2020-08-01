function isUnicode(){
	const el=document.createElement('canvas');
	const ctx=el.getContext("2d");
	const kaWidth=ctx.measureText('က').width;
	const patSintWidth=ctx.measureText('က္က').width;

	if(kaWidth==patSintWidth)
		return true;
	return false;
}

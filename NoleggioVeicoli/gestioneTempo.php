<?php
function controlloTemporale($gg,$mm,$aaaa)
{
	if($aaaa%400==0)
		return(controlloMensile($gg,$mm,true));
	elseif($aaaa%4==0 && $aaaa%100!=0)
		return(controlloMensile($gg,$mm,true));
	else
		return(controlloMensile($gg,$mm,false));
}
function controlloMensile($gg,$mm,$bisestile)
{
	if($bisestile)
	{
		if($mm==2)
		{
			if($gg>29)
				return false;
			else
				return true;
		}
		elseif($mm==4 || $mm==6 || $mm==9 || $mm==11)
		{
			if($gg>30)
				return false;
			else
				return true;
		}
		else
			return true;
	}
	else
	{
		if($mm==2)
		{
			if($gg>28)
				return false;
			else
				return true;
		}
		elseif($mm==4 || $mm==6 || $mm==9 || $mm==11)
		{
			if($gg>30)
				return false;
			else
				return true;
		}
		else
			return true;
	}
}
?>
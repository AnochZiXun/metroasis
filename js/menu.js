function hideshow(which)
{
if (!document.getElementById|document.all)
	{
	return
	}
else
	{
	if (document.getElementById)
		{
		oWhich = eval ("document.getElementById('" + which + "')")
		}
	else
		{
		oWhich = eval ("document.all." + which)
		}
	}
	window.focus()
	if (oWhich.style.display=="none")
		{
		oWhich.style.display=""
		}
	else
		{
		oWhich.style.display="none"
		}
}
function initclass02Expandible()
{
hideshow('test01')
hideshow('test02')
hideshow('m_test01')
hideshow('m_test02')
}

<?php
$spec_number = $globalVars["spec_number"];
$spec = false;
if(trim($spec_number) != "")
{
    $selectedSpec = getSpecs($spec_number);
	foreach($selectedSpec as $currSpec)
	{
	    $objectVars = get_object_vars($currSpec);
		$columnList = array_keys($objectVars);
		foreach($columnList as $currColumn)
                                {
                                    // Don't change the record ID
                                    if($currColumn != "recordID")
		        $globalVars[$currColumn] = $currSpec->$currColumn;
                                 }
			
		$spec=true;
	}
}
else
{
    $spec_number = "Customer";
   $globalVars["spec_number"] = "Customer";
}

?>
<link href="formCSS.css" rel="stylesheet" type="text/css" />

<style type="text/css">
  .style1 {
    font-size: small
  }

  .style2 {
    font-size: medium
  }

  .tableWborder {
    border: 1px solid #000000;
  }

  .forminput {
    font-size: 20px
  }

  .style5 {
    font-size: x-large
  }

  .warning {
    font-size: medium;
    color: #FF0000;
    font-weight: bold;
  }
</style>

<script type="text/JavaScript">
  function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function submitCheckin(actionvalue)
{
    document.entercheckin.action.value = actionvalue;
    document.entercheckin.submit();
}

function changeSpec(formObject)
{
    formObject.view.value = '';
    formObject.submit();
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
</script>
<script type="text/javascript" language="JavaScript">
  function trColorOn(elementId) {
    if (document.getElementById) {
      document.getElementById(elementId).style.backgroundColor = "#ccffcc"
    }
  }

  function trColorOff(elementId) {
    if (document.getElementById) {
      document.getElementById(elementId).style.backgroundColor = ""
    }
  }
</script>

<form action="/index.php?option=com_chassis_checkin&form=entercheckin" method="POST" enctype="multipart/form-data" name="entercheckin"
  id="entercheckin">
  <table border="0">
    <tr>
      <td nowrap>
        <p>&nbsp;</p>
      </td>
      <td colspan="2" rowspan="2" align="center" nowrap><span class="style5">CHASSIS CHECK IN FORM</span>
        <?php
if($globalVars["recordID"] != "")
    print '<br><br><span class="warning">This chassis has already been checked in, you are in Edit mode.</span><br><br>';
?>
        <p>
          <label>
            Chassis SPEC NO:</label>
          ##FORMFIELD_spec_number## <br>
          Unit Model # ##FORMFIELD_unitModel##
      </td>
      <td align="right" nowrap>&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="bottom" nowrap><label class="style1">Chassis Dealer
          ##FORMFIELD_chassis_dealer##
          <br />

          WO #
          ##FORMFIELD_workOrderNumber##
        </label></td>
      <td align="right" valign="bottom" nowrap><span class="style1">Check In Date
          ##FORMFIELD_checkin_date## <br />
          Cust. Truck #
          ##FORMFIELD_cust_truck_num## </span></td>
    </tr>
    <tr>
      <td align="left" valign="top" nowrap><label><span class="style1">Customer</span>
          ##FORMFIELD_customer_name##
          <span class="style1"><br />
            Part Number </span>
          <?php
if($spec)
    print $globalVars["part_number"];
else
{
?>
          ##FORMFIELD_part_number##
          <?
}
?>
        </label></td>
      <td align="right" valign="top" nowrap><label><span class="style1">IN #
          </span>
          ##FORMFIELD_in_number##
          <br />
          <span class="style1">TU PO# </span>

          ##FORMFIELD_tu_po_number##
        </label></td>
      <td align="right" valign="top" nowrap><span class="style1">DK #</span>
        ##FORMFIELD_dk_number##
        <br />
        <span class="style1">Mileage
          ##FORMFIELD_mileage## </span></td>
      <td align="right" valign="top" nowrap><label><span class="style1">VIN </span>
          ##FORMFIELD_vin##
          <br />
        </label>
        <span class="style1">Orig Mfg Date ##FORMFIELD_orig_mfg_date## </span></td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="top" nowrap>
        <table width="100%" border="0">
          <tr>
            <td align="center" valign="top">






              <table border="1" cellpadding="0" cellspacing="0" class="tableWborder" id="Chassis Description" type="single">
                <tr>
                  <td colspan="2" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">CHASSIS
                      DESCRIPTION </span></td>
                  <td align="center" bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">YES</span></td>
                  <td align="center" bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">NO</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Model Year </span></td>
                  <td align="center" nowrap><span class="style1">
                      ##FORMFIELD_chassis_year##
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_chassis_year_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Chassis Make </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["chassis_make"];
	print '<input type="hidden" name="chassis_make" value="' . $globalVars["chassis_make"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_chassis_make##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_chassis_make_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Model</span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["chassis_model"];
	print '<input type="hidden" name="chassis_model" value="' . $globalVars["chassis_model"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_chassis_model##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_chassis_model_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Drive Type </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["drive_type"];
	print '<input type="hidden" name="drive_type" value="' . $globalVars["drive_type"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_drive_type##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_drive_type_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Cab Style </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["cab_type"];
	print '<input type="hidden" name="cab_type" value="' . $globalVars["cab_type"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_cab_type##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_cab_type_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Color</span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["color"];
	print '<input type="hidden" name="color" value="' . $globalVars["color"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_color##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_color_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">ENGINE
                      INFORMATION </span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">YES</span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">NO</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Engine Make </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["engine_make"];
	print '<input type="hidden" name="engine_make" value="' . $globalVars["engine_make"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_engine_make##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_engine_make_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Engine Model </span></td>

                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["engine_model"];
	print '<input type="hidden" name="engine_model" value="' . $globalVars["engine_model"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_engine_model##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_engine_model_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Engine Size </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["engine_size"];
	print '<input type="hidden" name="engine_size" value="' . $globalVars["engine_size"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_engine_size##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_engine_size_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Engine HP </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["engine_hp"];
	print '<input type="hidden" name="engine_hp" value="' . $globalVars["engine_hp"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_engine_hp##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_engine_hp_yn##</label>
                    </span></td>
                </tr>

                <tr>
                  <td colspan="2" align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">TRANSMISSION
                      INFO. </span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">YES</span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">NO</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Trans Make </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["transmission_make"];
	print '<input type="hidden" name="transmission_make" value="' . $globalVars["transmission_make"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_transmission_make##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_transmission_make_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Trans Model </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["transmission_model"];
	print '<input type="hidden" name="transmission_model" value="' . $globalVars["transmission_model"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_transmission_model##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_transmission_model_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap class="style1">Trans Ser. # </td>
                  <td colspan="3" align="center" nowrap class="style1"><label>
                      ##FORMFIELD_transmission_serial_number##
                    </label></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Trans Type </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["transmission_type"];
	print '<input type="hidden" name="transmission_type" value="' . $globalVars["transmission_type"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_transmission_type##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_transmission_type_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1"># Trans Speeds </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["transmission_speeds"];
	print '<input type="hidden" name="transmission_speeds" value="' . $globalVars["transmission_speeds"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_transmission_speeds##
                      <?
}
?>
                    </span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_transmission_speeds_yn##</label>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2" align="right" nowrap><span class="style1">ALL WHEEL DRIVE</span></td>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <label></label>
                    </span><span class="style1">
                      <label>##FORMFIELD_all_wheel_drive##</label>
                    </span></td>
                </tr>
              </table>
            </td>
            <td align="center" valign="top">

              <table border="1" cellpadding="0" cellspacing="0" class="tableWborder" id="Fuel and Exhaust Information">
                <tr>
                  <td colspan="4" align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">FUEL
                      &amp; EXHAUST INFORMATION </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Fuel Tank Location </span></td>
                  <td align="center" nowrap class="style1"><span class="style1">
                      <label></label>
                      ##FORMFIELD_fuelTankLocationL##
                    </span></td>
                  <td align="center" nowrap class="style1">##FORMFIELD_fuelTankLocationR##</td>
                  <td align="center" nowrap class="style1">##FORMFIELD_fuelTankLocationCtr##</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1"># of Fuel Tanks </span></td>
                  <td colspan="3" align="center" nowrap>##FORMFIELD_numFuelTanks##</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Fuel Type </span><span class="style1"></span></td>
                  <td colspan="3" align="center" nowrap><span class="style1">
                      <label>
                        ##FORMFIELD_fuelType## </label>
                    </span></td>
                </tr>

                <tr>
                  <td align="right" nowrap><span class="style1">Exhaust Type </span></td>
                  <td colspan="3" align="center" nowrap><span class="style1">
                      ##FORMFIELD_exhaustType##
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Exhaust Location </span></td>
                  <td colspan="3" align="center" nowrap><span class="style1">
                      ##FORMFIELD_exhaustLoc##
                    </span></td>
                </tr>
                <tr>
                  <td colspan="4" align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">MISCELLANEOUS</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Key Code </span></td>
                  <td colspan="3" align="center" nowrap><span class="style1">
                      ##FORMFIELD_keyCode##
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1"># of Keys </span></td>
                  <td colspan="3" align="center" nowrap><span class="style1">
                      ##FORMFIELD_numKeys##
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Brake Type </span></td>
                  <td colspan="3" align="center" nowrap>##FORMFIELD_brakeType##</td>
                </tr>

                <tr>
                  <td align="right" nowrap><span class="style1">Frame Type </span></td>
                  <td colspan="3" align="center" nowrap>##FORMFIELD_frameType##</td>
                </tr>
                <tr>
                  <td colspan="4" align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">DRIVELINE</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Transfer Case Mfr. </span></td>
                  <td colspan="3" align="center" nowrap><span class="style1">
                      ##FORMFIELD_transferCaseMfr##
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Transfer Case Model </span></td>
                  <td colspan="3" nowrap><span class="style1">
                      ##FORMFIELD_transferCaseModel##
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">PTO Openings </span></td>
                  <td nowrap><span class="style1">
                      <label></label>
                      ##FORMFIELD_lPTOOpening##</span></td>
                  <td nowrap><span class="style1">
                      <label></label>
                      ##FORMFIELD_rPTOOpening##</span></td>
                  <td nowrap><span class="style1">##FORMFIELD_bPTOOpening##</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1"># of PTO's </span></td>
                  <td colspan="3" align="center" nowrap><span class="style1">
                      ##FORMFIELD_numPTOs##
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">PTO Pattern </span></td>
                  <td colspan="3" align="center" nowrap>
                    ##FORMFIELD_PTOPattern##</td>
                </tr>
              </table>
            </td>
            <td align="center" valign="top">
              <table class="tableWborder" border="1" cellpadding="0" cellspacing="0" id="Chassis Weights">
                <tr>
                  <td colspan="2" align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">CHASSIS
                      WEIGHTS </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Bare Chas. Wt. (Total Req.) </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["bare_chassis_weight"];
	print '<input type="hidden" name="bare_chassis_weight" value="' . $globalVars["bare_chassis_weight"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_bare_chassis_weight##
                      <?
}
?>
                      lbs. </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Front Axle (Actual) </span></td>
                  <td align="center" nowrap><span class="style1">

                      ##FORMFIELD_chassisFrontAxleActual##
                      lbs.</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Rear Axle (Actual)</span></td>
                  <td align="center" nowrap><span class="style1"> ##FORMFIELD_chassisRearAxleActual## lbs.</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap class="style1">Rear Rear Axle (Actual) </td>
                  <td align="center" nowrap class="style1">##FORMFIELD_chassisRearRearAxleActual## lbs. </td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Bare Chas. Wt. (Total Actual) </span></td>
                  <td align="center" nowrap><span class="style1"> ##FORMFIELD_bareChasWtActual##
                      lbs.</span></td>
                </tr>
                <tr>
                  <td colspan="2" nowrap>&nbsp;</td>
                </tr>

                <tr>
                  <td colspan="2" align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">AXLE
                      INFORMATION</span> </td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">GVWR (Req.) </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["gvwr"];
	print '<input type="hidden" name="gvwr" value="' . $globalVars["gvwr"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_gvwr##
                      <?
}
?>
                      lbs. </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">GVWR (Actual) </span></td>
                  <td align="center" nowrap><span class="style1">
                      ##FORMFIELD_GVWRActual##
                      lbs.</span></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["front_axle"];
	print '<input type="hidden" name="front_axle" value="' . $globalVars["front_axle"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_front_axle##
                      <?
}
?>
                      &nbsp;</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Front GVWR (Req.) </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["front_gvwr"];
	print '<input type="hidden" name="front_gvwr" value="' . $globalVars["front_gvwr"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_front_gvwr##
                      <?
}
?>
                      lbs. </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap class="style1">Front Axle (Actual) </td>
                  <td align="center" nowrap class="style1">##FORMFIELD_frontAxleActual##
                    lbs. </td>
                </tr>
                <tr>
                  <td colspan="2" align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["rear_axle"];
	print '<input type="hidden" name="rear_axle" value="' . $globalVars["rear_axle"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_rear_axle##
                      <?
}
?>
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Rear GVWR (Req.) </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["rear_gvwr"];
	print '<input type="hidden" name="rear_gvwr" value="' . $globalVars["rear_gvwr"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_rear_gvwr##
                      <?
}
?>
                      lbs. </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap class="style1">Rear Axle (Actual) </td>
                  <td align="center" nowrap class="style1">##FORMFIELD_rearAxleActual##
                    lbs. </td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Tandem Axle Cap. (Req.) </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["tandem_axle_weight"];
	print '<input type="hidden" name="tandem_axle_weight" value="' . $globalVars["tandem_axle_weight"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_tandem_axle_weight##
                      <?
}
?>
                      lbs. </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Tandem Axle (Actual) </span></td>
                  <td align="center" nowrap><span class="style1">
                      ##FORMFIELD_tandemAxleActual##
                      lbs.</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">CA (Req.) </span></td>
                  <td align="center" nowrap><span class="style1">
                      <?php
if($spec)
{
    print $globalVars["ca"];
	print '<input type="hidden" name="ca" value="' . $globalVars["ca"] . '">' . "\n";
}
else
{
?>
                      ##FORMFIELD_ca##
                      <?
}
?>
                      inches</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">CA (Actual) </span></td>
                  <td align="center" nowrap><span class="style1">
                      ##FORMFIELD_CAActual##
                      inches</span></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" nowrap class="style1">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="top" nowrap>
        <table border="0">
          <tr>
            <td rowspan="2" align="center" valign="top">
              <table border="1" cellpadding="0" cellspacing="0" class="tableWborder">
                <tr>
                  <td align="center" bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">SERVICE CHECK </span></td>
                  <td align="center" bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">YES</span></td>
                  <td align="center" bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">NO</span></td>
                </tr>
                <tr>
                  <td align="right"><span class="style1">Air Horn</span></td>
                  <td colspan="2" align="center">##FORMFIELD_horn##</td>
                </tr>
                <tr>
                  <td align="right" class="style1">Location</td>
                  <td colspan="2" align="center" class="style1">##FORMFIELD_hornLocation##</td>
                </tr>
                <tr>
                  <td align="right"><span class="style1">Jack</span></td>
                  <td colspan="2" align="center">##FORMFIELD_jack##</td>
                </tr>
                <tr>
                  <td align="right"><span class="style1">Jack Tools </span></td>
                  <td colspan="2" align="center">##FORMFIELD_jackTools##</td>
                </tr>
                <tr>
                  <td align="right"><span class="style1">Lights</span></td>
                  <td colspan="2" align="center">##FORMFIELD_lights##</td>
                </tr>
                <tr>
                  <td align="right"><span class="style1">Antenna</span></td>
                  <td colspan="2" align="center">##FORMFIELD_antenna##</td>
                </tr>
                <tr>
                  <td align="right"><span class="style1">Radio</span></td>
                  <td colspan="2" align="center">##FORMFIELD_radio##</td>
                </tr>
                <tr>
                  <td align="right" class="style1"><span class="style1">Cert. Incom. Veh. Doc. </span></td>
                  <td colspan="2" align="center" class="style1">##FORMFIELD_certIncompleteVehDoc##</td>
                </tr>
              </table>
            </td>
            <td rowspan="2" align="center" valign="top">
              <table border="1" cellpadding="0" cellspacing="0" class="tableWborder">
                <tr>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">SERVICE CHECK
                    </span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">YES</span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">NO</span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Spare Wheel </span></td>
                  <td colspan="2" align="center" nowrap>##FORMFIELD_spareWheel##</td>
                </tr>

                <tr>
                  <td align="right" nowrap><span class="style1">Spare Carrier </span></td>

                  <td colspan="2" align="center" nowrap>##FORMFIELD_spareCarrier##</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Air Conditioner </span></td>
                  <td colspan="2" align="center" nowrap>##FORMFIELD_airConditioner##</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Floor Mats (loose) </span></td>
                  <td colspan="2" align="center" nowrap>##FORMFIELD_floorMats##</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Battery Charged </span></td>
                  <td colspan="2" align="center" nowrap>##FORMFIELD_batteryCharged##</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Spare Tire </span></td>
                  <td colspan="2" align="center" nowrap>##FORMFIELD_spareTire##</td>
                </tr>

              </table>
            </td>
            <td valign="top">
              <table border="1" cellpadding="0" cellspacing="0" class="tableWborder">
                <tr>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style1">Tires &amp;
                      Wheels </span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">QTY</span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">SIZE</span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">BRAND</span></td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC" class="style1">Rated Tire Pressure
                  </td>
                  <td align="center" nowrap bordercolor="#000000" bgcolor="#CCCCCC" class="style1">WHEEL DIA.</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Front</span></td>
                  <td align="center" nowrap><span class="style1">
                      ##FORMFIELD_numFrontTires##
                    </span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_frontTireSize##</span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_frontTireBrand##</span></td>
                  <td align="center" nowrap class="style1">##FORMFIELD_frontTirePressure## psi </td>
                  <td align="center" nowrap class="style1">##FORMFIELD_fWheelDia## in. </td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Rear</span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_numRearTires##</span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_rearTireSize##</span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_rearTireBrand##</span></td>
                  <td align="center" nowrap class="style1">##FORMFIELD_rearTirePressure## psi </td>
                  <td align="center" nowrap class="style1">##FORMFIELD_rWheelDia## in. </td>
                </tr>
                <tr>
                  <td height="24" align="right" nowrap><span class="style1">Tandem</span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_numTandemTires##</span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_tandemTireSize##</span></td>
                  <td align="center" nowrap><span class="style1">##FORMFIELD_tandemTireBrand##</span></td>
                  <td align="center" nowrap class="style1">##FORMFIELD_tandemTirePressure## psi </td>
                  <td align="center" nowrap class="style1">##FORMFIELD_tWheelDia## in. </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td height="101" valign="top">
              <table border="1" cellpadding="0" cellspacing="0" class="tableWborder">
                <tr>
                  <td align="right" nowrap><span class="style1"># of Batteries </span></td>
                  <td align="left" nowrap><span class="style1">
                      ##FORMFIELD_numBatteries##
                    </span></td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Glass Condition </span></td>
                  <td align="left" nowrap>##FORMFIELD_glassCondition## </td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Antifreeze Rating </span></td>
                  <td align="left" nowrap class="style1">-
                    ##FORMFIELD_antiFreezeRating##
                    F&deg;</td>
                </tr>
                <tr>
                  <td align="right" nowrap><span class="style1">Oil Guage </span></td>
                  <td align="left" nowrap class="style1">##FORMFIELD_oilGaugePSI##
                    PSI </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" nowrap><span class="style2">Chassis Condition:
          ##FORMFIELD_chassisCondition##
        </span></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" nowrap><span class="style2">Damages or Comments:
          ##FORMFIELD_damagesOrComments##
        </span></td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" nowrap><span class="style2">Obstructions:
          ##FORMFIELD_obstructionsDesc##
        </span></td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap>
        <table class="tableWborder" border="1" cellpadding="2" cellspacing="0">
          <tr>
            <td colspan="2" align="center" bordercolor="#000000" bgcolor="#CCCCCC"><span class="style2">CHASSIS
                MEASUREMENTS </span></td>
            <td rowspan="7" align="center"><img src="/images/chassis_diagram.gif" alt="Chassis Diag"></td>
          </tr>
          <tr>
            <td align="left"><span class="style1">A=
                ##FORMFIELD_chassisMeasA##
                inches </span></td>
            <td align="left"><span class="style1">G=
                ##FORMFIELD_chassisMeasG##
                inches </span></td>
          </tr>
          <tr align="left">
            <td height="25"><span class="style1">B=
                ##FORMFIELD_chassisMeasB##
                inches </span></td>
            <td><span class="style1">H=
                ##FORMFIELD_chassisMeasH##
                inches </span></td>
          </tr>
          <tr align="left">
            <td height="25"><span class="style1">C=
                ##FORMFIELD_chassisMeasC##
                inches </span></td>
            <td><span class="style1">I=
                ##FORMFIELD_chassisMeasI##
                inches </span></td>
          </tr>
          <tr align="left">
            <td height="25"><span class="style1">D=
                ##FORMFIELD_chassisMeasD##
                inches </span></td>
            <td><span class="style1">J=
                ##FORMFIELD_chassisMeasJ##
                inches </span></td>
          </tr>
          <tr align="left">
            <td height="25"><span class="style1">E=
                ##FORMFIELD_chassisMeasE##
                inches </span></td>
            <td><span class="style1">K=
                ##FORMFIELD_chassisMeasK##
                inches </span></td>
          </tr>
          <tr align="left">
            <td height="25"><span class="style1">F=
                ##FORMFIELD_chassisMeasF##
                inches </span></td>
            <td><span class="style1"></span></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="4" align="left" valign="middle" nowrap><span class="style2">Check In By:
          ##FORMFIELD_checkInBy##
        </span></td>
    </tr>
    <tr>
      <td colspan="4" align="center" valign="middle" nowrap>
        <span class="titleCell">
          <input type="hidden" name="action" value="">
          ##FORMFIELD_recordID##
          <input type="hidden" name="view" value="ccindetail">
          <a href="javascript:submitCheckin('save');" class="btn" id="btn">Submit</a></span></td>
    </tr>
  </table>
</form>
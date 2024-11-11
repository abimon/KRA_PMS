<title>Paye Slip</title>

<div style="text-align: center;">
    <h2>PAYE SLIP</h2>
</div>
<div style="padding:20px 20px 40px 20px; border: 2px solid black;border-radius:12px;">
    <h4>Tax Payer's Details</h4>
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">Name:</div>
    <div style="width:60%;float:left;">{{$item->user->fname}} {{$item->user->mname}} {{$item->user->lname}}
    </div>
    </p>
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">Email:</div>
    <div style="width:60%;float:left;">{{$item->user->email}}</div>
    </p>
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">KRA PIN:</div>
    <div style="width:60%;float:left;">{{$item->user->kra_pin}}</div>
    </p>
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">ID Card:</div>
    <div style="width:60%;float:left;">{{$item->user->id_number}}</div>
    </p>
</div>
<hr>
<section style="padding:20px 20px 40px 20px; border: 2px solid black;border-radius:12px;">
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">Basic Salary:</div>
    <div style="width:60%;float:left;">{{$item->basic_salary}}</div>
    </p>
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">Allowances:</div>
    <div style="width:60%;float:left;">{{$item->allowances}}</div>
    </p>
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">S.H.I.F:</div>
    <div style="width:60%;float:left;">{{$item->insurance}}</div>
    </p>
    <p style="width:50%;">
    <div style="width:30%;font-weight:bold;float:left;">N.S.S.F:</div>
    <div style="width:60%;float:left;">{{$item->pension}}</div>
    </p>
</section>
<p style="width:50%; text-align:center;">
<div style="width:30%;font-weight:bold;float:left;">PAYE:</div>
<div style="width:60%;float:left;">{{$paye}}</div>
</p>
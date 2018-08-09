<script>
    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table, th, td { border: 1px solid black; border-collapse: collapse; }' +
            '                                           th, td { padding: 5px; }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
            '                                       ' +
            '                                   } } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }

</script>

<div id="divToPrint">

    <div>

        <p class="center underline" style="font-size: 18px;">

            ALLOTMENT SHEET OF NFSA (AAY & PHH + SPHH) & RKSY-I & RKSY-II 2nd F.N. FOR JUNE - 2018

        </p>

    </div>

    <div>

        <p class="inline">

            Memo No.-

        </p>

        <p class="center inline" style="margin-left: 80%">

            Date:-

        </p>

    </div>

    <br style="line-height: 15px;">

    <div>

       <p>

           M/S Laxmi Narayan Stores, M.R. Distributor, Belgram,
           Udaynarayanpur, Howrah. You hereby instructed to deliver
           M.R. Cereals to the following M.R. Dealers of U.N.Pur as per allocation
           payment at Govt. fixed rate against proper cash memo.

       </p>

    </div>


    <div>

        <table class="center" style="width: 100%">

            <tr>

                <td rowspan="2"><b>SCALE</b></td>

                <td>AAY RICE</td>

                <td>AAY ATTA</td>


                <td>PHH RICE</td>

                <td>PHH ATTA</td>


                <td>SPHH RICE</td>

                <td>SPHH ATTA</td>


                <td>RKSY-I RICE</td>

                <td>RKSY-I WHEAT</td>


                <td>RKSY-II RICE</td>

                <td>RKSY-II WHEAT</td>

            </tr>

            <tr>

                <td>100 Kg/Family</td>

                <td>100 Kg/Family</td>


                <td>100 Kg/Head</td>

                <td>100 Kg/Head</td>


                <td>100 Kg/Head</td>

                <td>100 Kg/Head</td>


                <td>100 Kg/Head</td>

                <td>100 Kg/Head</td>


                <td>100 Kg/Head</td>

                <td>100 Kg/Head</td>

            </tr>

        </table>

    </div>

    <br style="line-height: 15px;">

    <div>

        <table style="width: 100%;">

            <thead style="text-align: center;" >

            <tr>

                <th>MR<br>NO</th>

                <th>NAME OF<br>DEALER</th>

                <th>ANCHAL</th>


                <th>AAY<br>FAMILY</th>

                <th>RICE</th>

                <th>ATTA</th>


                <th>PHH<br>HEAD</th>

                <th>RICE</th>

                <th>ATTA</th>


                <th>SPHH<br>HEAD</th>

                <th>RICE</th>

                <th>ATTA</th>


                <th>RKSY-I<br>HEAD</th>

                <th>RICE</th>

                <th>WHEAT</th>


                <th>RKSY-II<br>HEAD</th>

                <th>RICE</th>

                <th>WHEAT</th>

            </tr>

            </thead>

            <tbody style="text-align: right;" >

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">1</td>

                <td style="text-align: center;">P.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            <tr>

                <td style="text-align: center;">2</td>

                <td style="text-align: center;">R.K Ghosh</td>

                <td>RDA</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>


                <td>30</td>

                <td>2.25</td>

                <td>2.85</td>

            </tr>

            </tbody>

        </table>

    </div>

</div>


<div class="modal-footer">

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <button class="btn btn-secondary" type="button" onclick="printDiv();">Print</button>

</div>
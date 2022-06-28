<?= $this->extend("templates/index") ?>
<?= $this->section("content") ?>

<?php 
$rsvpVerified = 0;
$rsvpUnverified = 0;
$rsvpTolak = 0;
$multimedia = 0;
$software = 0;
$network = 0;

$deletedUser = [];
$admin = 0;
$uns = 0;
$nonUns = 0;

foreach ($reservations as $rsvp) {
    if ($rsvp->status == "verif") {
        switch ($rsvp->id_lab) {
            case 0:
                $software++;
                break;
            case 1:
                $multimedia++;
                break;
            case 2:
                $network++;
                break;
        }
        $rsvpVerified++;
    } elseif ($rsvp->status == "unverif") {
        $rsvpUnverified++;
    } else {
        $rsvpTolak++;
    }
}

foreach ($deletedUsers as $user) {
    array_push($deletedUser, $user->id);
}

foreach ($roles as $role) {
    if (!in_array($role->user_id, $deletedUser)) {
        switch ($role->group_id) {
            case 1:
                $admin++;
                break;
            case 2:
                $uns++;
                break;
            case 3:
                $nonUns++;
                break;
        }
    }
}
?>

<section class="section">
    <main>
        <div class="container mt-5">
            <div class="main-content container-fluid">
                <div class="card px-3 py-3">
                <div class="section-header">
                    <h1>Admin Dashboard</h1>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <div id="active-user-chart" style="height: 300px; width: 100%;"></div>
                    </div>
                    <div class="col-sm">
                        <div id="user-access-chart" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                <br>
                <br>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <div id="rsvp-by-time" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm">
                        <div id="rsvp-status-chart" style="height: 300px; width: 100%;"></div>
                    </div>
                    <div class="col-sm">
                        <div id="rsvp-labs" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div id="viewmodal" style="display: none;"></div>
    </main>
</section>

<script>
    Highcharts.chart('active-user-chart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<b>Active Users</b>'
    },
    tooltip: {
        pointFormat: '<b>{series.name}</b>: {point.y} users'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} users'
            }
        }
    },
    series: [{
        name: 'Total',
        colorByPoint: true,
        data: [{
            name: 'Admin',
            y: <?php echo $admin ?>,
            sliced: true,
            selected: true,
            color: '#8e44ad'
        }, {
            name: 'User UNS',
            y: <?php echo $uns ?>,
            color: '#2980b9'
        }, {
            name: 'User Non-UNS',
            y: <?php echo $nonUns ?>,
            color: '#34495e'
        }]
    }]
});

Highcharts.chart('user-access-chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<b>User Access</b>'
    },
    xAxis: {
        categories: [
            'Time'
        ],
        crosshair: true,
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total User'
        },
        tickInterval: 1 
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} users</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Today',
        data: [<?php echo $dailyAccess?>],
        color: '#fd9644'

    }, {
        name: 'This Month',
        data: [<?php echo $monthlyAccess?>],
        color: '#d1d8e0'

    }, {
        name: 'This Year',
        data: [<?php echo $yearlyAccess?>],
        color: '#0fb9b1'

    }]
});

Highcharts.chart('rsvp-by-time', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<b>Verified Reservation by Time </b>'
    },
    xAxis: {
        categories: [
            'Time'
        ],
        crosshair: true,
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Reservation'
        },
        tickInterval: 1 
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} reservations</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Today',
        data: [<?php echo $dailyRsvp?>],
        color: '#3867d6'

    }, {
        name: 'This Month',
        data: [<?php echo $monthlyRsvp?>],
        color: '#4b6584'

    }, {
        name: 'This Year',
        data: [<?php echo $yearlyRsvp?>],
        color: '#a55eea'

    }]
});

Highcharts.chart('rsvp-status-chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<b>Reservation Status </b>'
    },
    xAxis: {
        categories: [
            'Status'
        ],
        crosshair: true,
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Reservation'
        },
        tickInterval: 1 
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} reservations</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Verified/Accepted',
        data: [<?php echo $rsvpVerified?>],
        color: '#27ae60'

    }, {
        name: 'Unverified',
        data: [<?php echo $rsvpUnverified?>],
        color: '#f1c40f'

    }, {
        name: 'Not Accepted',
        data: [<?php echo $rsvpTolak?>],
        color: '#c0392b'

    }]
});

Highcharts.chart('rsvp-labs', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<b>Verified Reservation Each Laboratory </b>'
    },
    xAxis: {
        categories: [
            'Laboratory'
        ],
        crosshair: true,
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Verified Reservation'
        },
        tickInterval: 1 
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} reservations</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Software Engineering Laboratory',
        data: [<?php echo $software?>],
        color: '#1dd1a1'

    }, {
        name: 'Multimedia Laboratory',
        data: [<?php echo $multimedia?>],
        color: '#f368e0'

    }, {
        name: 'Computer Network and Instrumentation Laboratory',
        data: [<?php echo $network?>],
        color: '#8395a7'

    }]
});
</script>

<?= $this->Endsection("content") ?>
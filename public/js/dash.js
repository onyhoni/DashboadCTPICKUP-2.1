document.addEventListener("DOMContentLoaded", () => {

  let myChartRegional = null;
  let myChartCustomer = null;
  let myChartBranch = null;
  let myChartMonth = null;
  let myChartCase = null;



  function dashboard() {
    const startTime = $("#startTime").val();
    const endTime = $("#endTime").val();
    const statusDash = $("#status").val();
    const CaseDash = $("#case").val();
    const RegionalDash = $("#regional").val();


    $.ajax({
      url: "http://localhost:8080/datadashboard",
      dataType: "json",
      data: { startTime, endTime, statusDash, CaseDash, RegionalDash},
      success: function (result) {


        $('#total-tiket').html(result.dataTiket.totalTiket);
        $('#total-open').html(result.dataTiket.OPEN);
        $('#total-close').html(result.dataTiket.CLOSE);
        $('#total-progress').html(result.dataTiket.PROGRESS)


        // chart Regional
        const dataReg= result.dataRegional
        const reg = dataReg.id
        const regVal = dataReg.value
        const dataRegional = {
            labels: reg,
            datasets: [{
                    label: 'Open',
                    data: regVal.OPEN,
                    backgroundColor: '#8b5cf6'
                }, {
                    label: 'In-Proggress',
                    data: regVal.PROGRESS,
                    backgroundColor: '#FFD572'
                },
                {
                    label: 'Close',
                    data: regVal.CLOSE,
                    backgroundColor: '#ede9fe'
                }
            ]
        };

        const configRegional = {
            type: 'bar',
            data: dataRegional,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 12
                            }
                        },
                        position: 'bottom'
                    }
                },
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true
                    }
                }
            },
        };

        if(myChartRegional!= null) {
            myChartRegional.destroy();
        }
        myChartRegional = new Chart(
            document.getElementById('barChart'),
            configRegional
        );

        // EndChartRegioanl

         // Chart_customer
         const dataCust= result.dataCustomer
         const dataChartcustomer = dataCust.id
         const dataChartValCustomer = dataCust.value
         const dataCustomer = {
             labels: dataChartcustomer,
             datasets: [{
                 label: 'Top 10 Customer Ticket',
                 data: dataChartValCustomer,
                 backgroundColor: [
                     'rgb(49, 46, 129)',
                     'rgb(55, 48, 163)',
                     'rgb(67, 56, 202)',
                     'rgb(79, 70, 229)',
                     'rgb(99, 102, 241)',
                     'rgb(129, 140, 248)',
                     'rgb(165, 180, 252)',
                     'rgb(199, 210, 254)',
                     'rgb(224, 231, 255)',
                     'rgb(238, 242, 255)'
                 ],
             }]
         };

         const config = {
             type: 'bar',
             data: dataCustomer,
             options: {
                 plugins: {
                     legend: {
                         labels: {
                             // This more specific font property overrides the global property
                             font: {
                                 size: 15
                             }
                         }
                     }
                 },
                 maintainAspectRatio: false,
                 indexAxis: 'y',
                 scales: {
                     y: {
                         beginAtZero: true
                     }
                 }
             },
         };
         if(myChartCustomer!= null) {
             myChartCustomer.destroy();
         }

         myChartCustomer = new Chart(
             document.getElementById('chart-customer'),
             config
         );

         // end Chart Customer


         // Chart Top 10 Branch
        const dataBran= result.dataOrigin
        const dataChartBranch = dataBran.id
        const dataChartValBranch = dataBran.value
        const dataBranch = {
            labels: dataChartBranch,
            datasets: [{
                label: 'Top 10 Branch Ticket',
                data: dataChartValBranch,
                backgroundColor: [
                    '#164e63',
                    '#155e75',
                    '#0e7490',
                    '#0891b2',
                    '#06b6d4',
                    '#22d3ee',
                    '#67e8f9',
                    '#a5f3fc',
                    '#cffafe',
                    '#ecfeff'
                ],
            }]
        };

        const configBranch = {
            type: 'bar',
            data: dataBranch,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 15
                            }
                        }
                    }
                },
                maintainAspectRatio: false,
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        if(myChartBranch!= null) {
            myChartBranch.destroy();
        }
        myChartBranch = new Chart(
            document.getElementById('chart-branch'),
            configBranch
        );

        // Chart End Branch

        // Month


        // Chart Industry
        const dataMonth= result.dataMonths
        const ind = dataMonth.id
        const indsVal = dataMonth.value
        const dataMonthustry = {
            labels: ind,
            datasets: [{
                    label: 'Open',
                    data: indsVal.OPEN,
                    backgroundColor: '#F94144'
                }, {
                    label: 'In-Proggress',
                    data: indsVal.PROGRESS,
                    backgroundColor: '#90BE6D'
                },
                {
                    label: 'Close',
                    data: indsVal.CLOSE,
                    backgroundColor: '#2D9CDB'
                }
            ]
        };

        const configMonth = {
            type: 'bar',
            data: dataMonthustry,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 12
                            }
                        },
                        position: 'bottom'
                    }
                },
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        if(myChartMonth!= null) {
            myChartMonth.destroy();
        }
        myChartMonth = new Chart(
            document.getElementById('chart-month'),
            configMonth
        );

        // End Month


        // Chart By Case
        const dataCat= result.dataCase
        const dataChartCase = dataCat.id
        const dataChartValCase = dataCat.value
        const dataCase = {
            labels: dataChartCase,
            datasets: [{
                label: 'My First Dataset',
                data: dataChartValCase,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    '#FF9364',
                    'rgb(255, 205, 86)',
                    '#f97316'
                ],
            }]
        };

        const configCase = {
            type: 'doughnut',
            data: dataCase,
            options: {
                plugins: {
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            font: {
                                size: 12
                            },
                        },
                        position: 'bottom'

                    }
                },
                maintainAspectRatio: false,
            },
        };
        if(myChartCase!= null) {
            myChartCase.destroy();
        }
        myChartCase = new Chart(
            document.getElementById('chart-Case'),
            configCase
        );
        // End Chart Category

      },
    });
  }

  dashboard();

  $("#status ,#startTime , #endTime, #case ,#regional").on("change", function () {
    dashboard();
  });
});

$(document).ready(function () {
  chart();

  function chart() {
    $.ajax({
      url: `/chart`,
      type: 'GET',
      loading: true,
      success: function (response) {
        renderChartOrdersMonth(response.data.recentOrdersMonth);
        renderChartOrdersYear(response.data.recentOrdersYear);
        renderPercentOrders(response.data.percentOrdersYear);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        toastr.error(jqXHR.responseJSON.userMsg);
      }
    });
  }

  function renderChartOrdersMonth(recentOrdersMonth) {
    let dataDatasets = [];
    for (let i = 0; i < recentOrdersMonth.length; i++) {
      dataDatasets.push({ x: recentOrdersMonth[i]['day'], y: recentOrdersMonth[i]['qty'] })
    }
    const ctx = $('#recent-orders-month');
    new Chart(ctx, {
      type: 'line',
      data: {
        datasets: [{
          data: dataDatasets,
          label: 'Đơn hàng',
          backgroundColor: 'rgb(39, 169, 227)',
          borderColor: 'rgb(39, 169, 227)',
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Đơn hàng 30 ngày gần nhất'
          }
        },
        scales: {
          y: {
            ticks: {
              // forces step size to be 50 units
              stepSize: 1
            }
          }
        }
      },
    });
  }

  function renderChartOrdersYear(recentOrdersYear) {
    let dataDatasets = [];
    for (let i = 0; i < recentOrdersYear.length; i++) {
      dataDatasets.push({ x: recentOrdersYear[i]['month'], y: recentOrdersYear[i]['qty'] })
    }
    const ctx = $('#recent-orders-year');
    new Chart(ctx, {
      type: 'bar',
      data: {
        datasets: [{
          data: dataDatasets,
          label: 'Đơn hàng',
          backgroundColor: 'rgb(39, 169, 227)',
          borderColor: 'rgb(39, 169, 227)',
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Đơn hàng 30 ngày gần nhất'
          }
        },
        scales: {
          y: {
            ticks: {
              // forces step size to be 50 units
              stepSize: 1
            }
          }
        }
      },
    });
  }

  function renderPercentOrders(percentOrdersYear) {
    if (!percentOrdersYear) {
      $('#percent-orders').parent().append(`<p class="text-warning text-center">Không đủ dữ liệu</p>`);
      $('#percent-orders').remove();
      return;
    }
    let dataLabels = [];
    let dataDatasets = [];
    for (let key in percentOrdersYear) {
      dataLabels.push(key);
      dataDatasets.push(percentOrdersYear[key]);
    }
    const ctx = $('#percent-orders');
    new Chart(ctx, {
      type: 'pie',

      data: {
        labels: dataLabels,
        datasets: [{
          data: dataDatasets,
          label: 'Đơn hàng',
          backgroundColor: [
            'rgb(39, 169, 227)',
            'rgb(255, 99, 132)',
          ],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'Đơn hàng theo tỷ lệ'
          }
        }
      },
    });
  }
})
<x-app-layout>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 min-h-screen flex flex-col gap-y-10">
        <div>
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-2xl font-black text-[#212C5F]">
                    Selamat Datang di Dashboard Rumahku Kost!
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between gap-10 mt-5">
            <a href="{{ route('penyewa') }}" class="border w-2/5 h-fit bg-[#FAEC22] rounded-md border-black">
                <div class="flex justify-around border-b border-black rounded-t-md p-2">
                    <p class="text-lg font-semibold">Penyewa</p>
                    <p>Detail</p>
                </div>
                <div class="flex items-center justify-around px-2 py-5">
                    <div>
                        <p class="text-2xl font-bold">{{ count($penyewa) }}</p>
                        <p class="font-semibold text-lg">Total Penyewa Kamar</p>
                    </div>
                    <div>
                        >
                    </div>
                </div>
            </a>
            <a href="{{ route('pemasukan') }}" class="border w-2/5 h-fit bg-[#8BDF80] rounded-md border-black">
                <div class="flex justify-around border-b border-black rounded-t-md p-2">
                    <p class="text-lg font-semibold">Pemasukan</p>
                    <p>Detail</p>
                </div>
                <div class="flex items-center justify-around px-2 py-5">
                    <div>
                        <p class="text-2xl font-bold">{{ 'Rp. ' . number_format($totalPemasukanCurrentMonth, 2, ',', '.') }}</p>
                        <p class="font-semibold text-lg">{{ $currentMonthName }} {{ $currentYear }}</p>
                    </div>
                    <div>
                        >
                    </div>
                </div>
            </a>
            <a href="{{ route('pengeluaran') }}" class="border w-2/5 h-fit bg-[#F55D5D] rounded-md border-black">
                <div class="flex justify-around border-b border-black rounded-t-md p-2">
                    <p class="text-lg font-semibold">Pengeluaran</p>
                    <p>Detail</p>
                </div>
                <div class="flex items-center justify-around px-2 py-5">
                    <div>
                        <p class="text-2xl font-bold">{{ 'Rp. ' . number_format($totalPengeluaranCurrentMonth, 2, ',', '.') }}</p>
                        <p class="font-semibold text-lg">{{ $currentMonthName }} {{ $currentYear }}</p>
                    </div>
                    <div>
                        >
                    </div>
                </div>
            </a>
        </div>
        <div class="rounded-md bg-white p-5">
            <h1 class="text-2xl font-bold">Perkiraan pembayaran pajak</h1>
            <div class="grid grid-cols-3 gap-10 mt-5">
              @foreach($pemasukanValuesVAT as $data => $value)
              <div>
                <p class="text-lg font-bold">Bulan {{ $data }}</p>
                <div class="flex items-center justify-between">
                  <div>
                    <p>Pemasukan:</p> 
                    <p>{{ 'Rp. ' . number_format($value['pemasukan'], 2, ',', '.') }}</p>
                  </div>
                  <div>
                    <p>Pajak:</p> 
                    <p>
                      {{ 'Rp. ' . number_format($value['pajak'], 2, ',', '.') }}</div>
                    </p>
                </div>
              </div>
              @endforeach
            </div>
        </div>
        <div class="rounded-md bg-white p-5">
            <h1 class="text-2xl font-bold">Grafik Keuangan Tahunan 2024</h1>
            <div class="flex gap-5">
                <div>Pemasukan</div>
                <div>Pengeluaran</div>
                </div>
                <div class="w-full bg-white rounded-lg shadow p-4 md:p-6">
                <div class="flex justify-between border-gray-200 border-b pb-3">
                    <dl>
                    <dt class="text-base font-normal text-gray-500 pb-1">Profit</dt>
                    <dd class="leading-none text-3xl font-bold text-gray-900">{{ 'Rp. ' . number_format($netBalance, 2, ',', '.') }}</dd>
                    </dl>
                </div>

                <div class="grid grid-cols-2 py-3">
                    <dl>
                    <dt class="text-base font-normal text-gray-500 pb-1">Income</dt>
                    <dd class="leading-none text-xl font-bold text-green-500">{{ 'Rp. ' . number_format($totalPemasukan, 2, ',', '.') }}</dd>
                    </dl>
                    <dl>
                    <dt class="text-base font-normal text-gray-500 pb-1">Expense</dt>
                    <dd class="leading-none text-xl font-bold text-red-600">-{{ 'Rp. ' . number_format($totalPengeluaran, 2, ',', '.') }}</dd>
                    </dl>
                </div>

                <div id="bar-chart"></div>
                </div>
        </div>
        <div class="rounded-md bg-white p-5">
            <h1 class="text-2xl font-bold">Perbandingan Pemasukan Tahun Lalu dan Tahun ini</h1>
            <div class="flex gap-5">
                <div>Tahun Lalu</div>
                <div>Tahun Ini</div>
            </div>
                
          <div class="max-w-sm w-full bg-white rounded-lg shadow p-4 md:p-6">

  <!-- Donut Chart -->
  <div class="py-6" id="donut-chart"></div>

  <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between">
    <div class="flex justify-between items-center pt-5">

  </div>
</div>

        </div>
    </div>

<script>
const netBalanceLastYear = @json($pemasukanLastYear);
const netBalance = @json($pemasukanThisYear);

const options = {
  series: [
    {
      name: "Pemasukan",
      color: "#31C48D",
      data: @json($pemasukanValues),
    },
    {
      name: "Pengeluaran",
      data: @json($pengeluaranValues),
      color: "#F05252",
    }
  ],
  chart: {
    sparkline: {
      enabled: false,
    },
    type: "bar",
    width: "100%",
    height: 400,
    toolbar: {
      show: false,
    }
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {
    bar: {
      horizontal: true,
      columnWidth: "100%",
      borderRadiusApplication: "end",
      borderRadius: 6,
      dataLabels: {
        position: "top",
      },
    },
  },
  legend: {
    show: true,
    position: "bottom",
  },
  dataLabels: {
    enabled: false,
  },
  tooltip: {
    shared: true,
    intersect: false,
    formatter: function (value) {
      return "Rp." + value
    }
  },
  xaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500'
      },
      formatter: function(value) {
        return "Rp." + value
      }
    },
    categories: @json($months),
    axisTicks: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500'
      }
    }
  },
  grid: {
    show: true,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -20
    },
  },
  fill: {
    opacity: 1,
  }
}

const getChartOptions = () => {
  return {
    series: [netBalanceLastYear, netBalance],
    colors: ["#1C64F2", "#16BDCA"],
    chart: {
      height: 320,
      width: "100%",
      type: "donut",
    },
    stroke: {
      colors: ["transparent"],
      lineCap: "",
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            name: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: 20,
            },
            total: {
              showAlways: true,
              show: true,
              label: "Pemasukan",
              fontFamily: "Inter, sans-serif",
              formatter: function (w) {
                const sum = w.globals.seriesTotals.reduce((a, b) => {
                  return a + b
                }, 0)
                return 'Rp.' + sum
              },
            },
            value: {
              show: true,
              fontFamily: "Inter, sans-serif",
              offsetY: -20,
              formatter: function (value) {
                return "Rp." + value
              },
            },
          },
          size: "80%",
        },
      },
    },
    grid: {
      padding: {
        top: -2,
      },
    },
    labels: ["2023", "2024"],
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      fontFamily: "Inter, sans-serif",
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return "Rp." + value
        },
      },
    },
    xaxis: {
      labels: {
        formatter: function (value) {
          return "Rp." + value
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
  }
}

if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
  chart.render();

  // Get all the checkboxes by their class name
  const checkboxes = document.querySelectorAll('#devices input[type="checkbox"]');

  // Function to handle the checkbox change event
  function handleCheckboxChange(event, chart) {
      const checkbox = event.target;
          chart.updateSeries([netBalanceLastYear, netBalance]);
  }

  // Attach the event listener to each checkbox
  checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', (event) => handleCheckboxChange(event, chart));
  });
}

if(document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("bar-chart"), options);
  chart.render();
}


    </script>
</x-app-layout>

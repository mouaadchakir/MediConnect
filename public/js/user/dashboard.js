document.addEventListener('DOMContentLoaded', function () {
 const userActivityCtx = document.getElementById('userActivityChart').getContext('2d');
const generateRandomData = () => Array.from({ length: 7 }, () => Math.floor(Math.random() * 1000));
const userActivityChart = new Chart(userActivityCtx, {
  type: 'line',
  data: {
    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
    datasets: [{
      label: 'Activité des utilisateurs',
      data: generateRandomData(),
      borderColor: getComputedStyle(document.documentElement).getPropertyValue('--primary').trim(),
      backgroundColor: 'rgba(44, 75, 255, 0.1)',
      tension: 0.4,
      fill: true
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        display: false
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          color: 'rgba(0, 0, 0, 0.05)'
        }
      },
      x: {
        grid: {
          display: false
        }
      }
    }
  }
});
setInterval(() => {
  userActivityChart.data.datasets[0].data = generateRandomData();
  userActivityChart.update();
}, 2000);
  const appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
  new Chart(appointmentsCtx, {
    type: 'doughnut',
    data: {
      labels: ['médecins', 'd\'utilisateurs'],
      datasets: [{
        data: [MIDSINE_COUNT, USER_COUNT],
        backgroundColor: [
          '#22c55e',
          '#f59e0b'
        ],
        borderWidth: 0
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            padding: 20,
            usePointStyle: true
          }
        }
      },
      cutout: '75%'
    }
  });
});
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('mouseenter', function () {
    this.style.transform = 'translateY(-4px)';
  });
  card.addEventListener('mouseleave', function () {
    this.style.transform = 'translateY(0)';
  });
});
document.querySelectorAll('.filter-btn').forEach(button => {
  button.addEventListener('click', function () {
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    this.classList.add('active');
  });
});

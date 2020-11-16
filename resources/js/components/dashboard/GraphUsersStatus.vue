<template>
    <GChart type="ColumnChart" :data="chartData" :options="chartOptions" />
</template>

<script>
export default {
    data() {
        return {
            // Array will be automatically processed with visualization.arrayToDataTable function
            chartData: [
                // ["Year", "Verificado", "Sin verificar"],
                // ["Abr", 10, 40],
            ],
            chartOptions: {
                hAxis: {
                    title: "Últimos Meses"
                },
                vAxis: {
                    title: "Cantidad"
                },
                chartArea: {
                    height: "56%",
                    width: "56%"
                },
                width: 600,
                height: 250,
                theme: "material"
                // legend: { position: "bottom" }
            }
        };
    },
    mounted() {
        this.getDataUsersStatus();
    },
    methods: {
        getDataUsersStatus() {
            const url = "/users-status";
            axios
                .get(url)
                .then(res => (this.chartData = res.data))
                .catch(err => console.log(err));
        }
    }
};
</script>

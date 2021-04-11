<template>
  <div class="home">
    Размер матрицы
    <input v-model="size_x" type="number"/> x
    <input v-model="size_x" type="number"/>
    <button @click="changeSize">Изменить размер</button>
    <br>
    Матрица
    <div v-for="(xValues, xIndex) in matrix" :key="`x_index_${xIndex}`">
      <input
          style="width: 50px"
          v-for="(yValue, yIndex) in xValues"
          :key="`x_index_${xIndex}-y_index_${yIndex}`"
          @change="changeItem(xIndex, yIndex, $event)"
          type="number" :value="yValue"/>
    </div>
    <br>
    <button @click="calcSum">Посчитать суммы диагоналей</button>

    <br><br>
    <div v-if="diagonalSums.length > 0">
      <div v-for="(info, index) in diagonalSums" :key="`answer_${index}`">
        {{info.name}} = {{info.sum}}
      </div>
    </div>
  </div>
</template>

<script>

import axios from "axios";

export default {
  data() {
    return {
      size_x: 3,
      matrix: [],
      diagonalSums: [],
    };
  },
  created() {
    this.changeSize();
  },
  methods: {
    changeItem(x, y, event) {
      this.matrix[x][y] = event.target.value
    },
    changeSize() {
      let matrix = [];
      for(let i = 0; i < this.size_x; i++){
        matrix[i] = [];
        for(let j = 0; j < this.size_x; j++){
          matrix[i][j] = 1;
        }
      }
      this.matrix = matrix;
    },
    calcSum() {
      axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
      axios({url: 'http://localhost:8000/api/v1/matrix/calcSum', data: {matrix: this.matrix}, method: 'POST' })
          .then(resp => {
            console.log(resp.data)
            this.diagonalSums = resp.data
          })
    }
  },
}
</script>

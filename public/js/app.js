const phpData = window.phpData || {};

const { createApp } = Vue;

createApp({
    data() {
        return {
            message: 'Привет, это Vue.js + Bootstrap!',
            phpData: phpData.phpData || 'Нет данных'
        };
    },
    methods: {
        changeMessage() {
            this.message = 'Текст изменён!';
        },
        async fetchData() {
            try {
                const response = await fetch('/src/api.php');
                const data = await response.json();
                this.message = data.message;
            } catch (error) {
                console.error('Ошибка:', error);
            }
        }
    }
}).mount('#app');
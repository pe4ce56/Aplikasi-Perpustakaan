
date = new Date();
var app = new Vue({
    el: '#app',
    data: {

        name: ''
    },
    computed: {
        borrowedDate: () => {
            return date.getFullYear() + '-'
                + ('0' + (date.getMonth() + 1)).slice(-2) + '-'
                + ('0' + date.getDate()).slice(-2);
        },
        returnedDate: () => {
            date.setDate(date.getDate() + 10);
            return date.getFullYear() + '-'
                + ('0' + (date.getMonth() + 1)).slice(-2) + '-'
                + ('0' + date.getDate()).slice(-2);
        }
    }
})



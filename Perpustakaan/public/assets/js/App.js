date = new Date();

var app = new Vue({

    el: '#app',
    data: {
        customerNIS: '',
        customerName: '',
        searchedCustomer: false,
        searchedBook: false,
        loading: true,
        students: [],
        searchStudent: [],

        bookID: '',
        books: [],
        amountOfBooks: [],
        searchBook: [],

        newTransactions: []
    },
    computed: {
        borrowedDate() {
            return date.getFullYear() + '-' +
                ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                ('0' + date.getDate()).slice(-2);
        },
        returnedDate() {
            date.setDate(date.getDate() + 10);
            return date.getFullYear() + '-' +
                ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                ('0' + date.getDate()).slice(-2);
        },
        getCustomers() {
            return this.searchStudent;
        },
        getBooks() {
            return this.searchBook;
        },
        getNewTransactions() {
            return this.newTransactions;
        }
    },
    methods: {
        searchingCustomer() {
            if (this.customerNIS) {
                this.searchStudent = this.students.filter(search => {
                    return search.NIS.toString().includes(this.customerNIS.toString());
                })
            } else {
                this.searchStudent = ''
            }
        },
        searchingBook() {
            if (this.bookID) {
                this.searchBook = this.books.filter(search => {
                    return search.id_buku.toString().toLowerCase().includes(this.bookID.toString().toLowerCase());
                })
            } else {
                this.searchBook = ''
            }
        },
        enteredDataCustomer() {
            if (this.searchStudent) {
                this.customerNIS = this.searchStudent[0].NIS;
                this.customerName = this.searchStudent[0].nama;
                this.$refs.bookID.focus();
            }
        },
        enteredDataBook() {
            if (this.searchBook[0]) {
                this.newTransactions.push(this.searchBook[0]);
                this.amountOfBooks.push(0);
                this.bookID = ''
            }
        }
    },
    mounted() {
        axios
            .get('http://127.0.0.1:8000/API/students')
            .then(response => {
                (this.students = response.data);
                this.loading = false;
            });
        axios
            .get('http://127.0.0.1:8000/API/books')
            .then(response => {
                (this.books = response.data);
                this.loading = false;
            })
    }
})
let base_url = window.location.origin;

const data = new Vue({
    el: "#app",
    data: {
        //data from api
        dataCustomers: [],
        dataBooks: [],
        //data olahan
        dataCustomer: {
            id: null,
            NIS: null,
            name: null
        },
        dataBook: {
            id: null,
            code: null,
            title: null,
            title: null
        },
        newTransaction: []
    },
    mounted: async function() {
        await axios
            .get(`${base_url}/transaction/getStudents`)
            .then(response => {
                this.dataCustomers = response.data;
            });
        await axios.get(`${base_url}/transaction/getBooks`).then(response => {
            this.dataBooks = response.data;
        });
        $("#clear-customer").click(() => {
            $("#NIS").val("");
        });
        $("#clear-book").click(() => {
            $("#book_code").val("");
        });

        // search customer
        $("#NIS")
            .autocomplete({
                source: this.dataCustomers,
                minLength: 1,
                select: (event, ui) => {
                    $("#NIS").val(ui.item.NIS);
                    return false;
                }
            })
            .data("ui-autocomplete")._renderItem = function(ul, item) {
            var inner_html = `<div class="list-item-container">
                    <div class="image">
                        <img src="${item.image}">
                    </div>
                    <div class="label ml-4 mt-1">
                        <h5>${item.NIS} - ${item.name}</h5>
                    </div>
                </div>`;
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append(inner_html)
                .appendTo(ul);
        };
        //search book
        $("#book_code")
            .autocomplete({
                source: this.dataBooks,
                minLength: 1,
                select: (event, ui) => {
                    // this.dataBook.id = ui.item.id;
                    // this.dataBook.code = ui.item.code;
                    // this.dataBook.title = ui.item.title;
                    // this.dataBook.image = ui.item.image;
                    $("#book_code").val(ui.item.code);
                    return false;
                }
            })
            .data("ui-autocomplete")._renderItem = function(ul, item) {
            var inner_html = `<div class="list-item-container">
                        <div class="image">
                            <img src="${item.image}">
                        </div>
                        <div class="label ml-4 mt-1">
                            <h5>${item.code} - ${item.title}</h5>
                        </div>
                    </div>`;
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append(inner_html)
                .appendTo(ul);
        };
    },
    methods: {
        addBook() {
            if ($("#book_code").val()) {
                let dataSearch;
                for (let i in this.dataBooks) {
                    if (this.dataBooks[i].code == $("#book_code").val()) {
                        // adding quantity attribut to obj dataBooks
                        this.$set(this.dataBooks[i], "quantity", 1);
                        this.newTransaction.push(this.dataBooks[i]);
                        $("#book_code").val("");
                        return;
                    }
                }
                Swal.fire({
                    title: "Oops!",
                    text: "Book not found!",
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            }
        },
        clearAll() {
            this.newTransaction = [];
            this.dataCustomer.id = "";
            this.dataCustomer.NIS = "";
            this.dataCustomer.name = "";
        },
        selectCustomer() {
            if ($("#NIS").val()) {
                for (let i in this.dataCustomers) {
                    if (this.dataCustomers[i].NIS == $("#NIS").val()) {
                        this.dataCustomer.id = this.dataCustomers[i].id;
                        this.dataCustomer.NIS = this.dataCustomers[i].NIS;
                        this.dataCustomer.name = this.dataCustomers[i].name;
                        return;
                    }
                }

                Swal.fire({
                    title: "Oops!",
                    text: "Student not found!",
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            }
        }
    }
});

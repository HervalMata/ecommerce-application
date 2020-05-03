<template>
    <div id="">
        <div class="tile">
            <h3 class="tile-title">Atributos do Produto</h3>
            <hr>
            <div class= "tile-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent">Selecione um atributo<span class="m-l-5 text-danger"></span> </label>
                            <select id="parent" class="form-control custom-select mt-15" v-model="attribute" @change="selectAttribute(attribute)">
                                <option value="attribute" v-for="attribute in attributes">{{ attribute.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile" v-if="attributeSelected">
            <h3 class="tile-title">Adicionar atributo para o produto</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="values">Selecione um valor<span class="m-l-5 text-danger"></span> </label>
                        <select id="values" class="form-control custom-select mt-15" v-model="attribute" @change="selectValue(value)">
                            <option value="value" v-for="value in attributeValues">{{ value.value }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" v-if="valueSelected">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="quantity">Quantidade</label>
                        <input class="form-control" type="number" id="quantity" v-model="currentQty">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="price">Preço</label>
                        <input class="form-control" type="text" id="price" v-model="currentPrice">
                        <small class="text-danger">Este preço será adicionado ao preço principal do produto na loja</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary" @click="addProductAttribute()">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="tile">
            <h3 class="tile-title">Atributos do Produto</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr class="text-center">
                            <th>Valor</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pa in productAttributes">
                                <td style="width: 25%" class="text-center">{{ pa.value}}</td>
                                <td style="width: 25%" class="text-center">{{ pa.quantity}}</td>
                                <td style="width: 25%" class="text-center">{{ pa.price}}</td>
                                <td style="width: 25%" class="text-center">
                                    <button class="btn btn-sm btn-danger" @click="deleteProductAttribute(pa)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "product-attributes",
        props: ['productid'],
        data() {
            return {
                productAttributes: [],
                attributes: [],
                attribute: {},
                attributeSelected: false,
                attributeValues: [],
                values: {},
                valueSelected: false,
                currentValue: '',
                currentQty: '',
                currentPrice: '',
            }
        },
        created: function() {
            this.loadAttributes(),
            this.loadProductAttributes(this.productid);
        },
        methods: {
            loadAttributes() {
                let _this = this;
                axios.get('/admin/products/attributes/load').then(function (response) {
                    _this.attributes = response.data;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            loadProductAttributes() {
                let attributeId = this.attributeid;
                let _this = this;
                axios.post('/admin/products/attributes', {
                    id: Id
                }).then(function (response) {
                    _this.productAttributes = response.data;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            selectAttribute(attribute) {
                let _this = this;
                let currentattributeId = this.attribute.id;
                axios.post('/admin/products/attributes/values', {
                    id: attribute.id
                }).then(function (response) {
                    _this.attributesValues = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
                this.attributeSelected = true;
            },
            selectValue(value) {
                this.valueSelected = true;
                this.currentValue = value.value;
                this.currentQty = value.quantity;
                this.currentPrice = value.price;
            },
            addProductAttribute() {
                if (this.currentQty === null || this.currentPrice === null) {
                    this.$swal("Erro, Alguns valores são requeridos", {
                        icon: "error",
                    });
                } else {
                    let _this = this;
                    let data = {
                        attribute_id: this.currentAttributeid,
                        value: this.currentValue,
                        quantity: this.currentQty,
                        price: this.currentPrice,
                        product_id: this.productid,
                    };
                    axios.post('/admin/products/attributes/add', {
                        data: data
                    }).then(function (response) {
                        this.$swal("Sucesso!" + response.data.message, {
                            icon: "success",
                        });
                        _this.currentValuem = "";
                        _this.currentQty = "";
                        _this.currentPrice = "";
                        _this.valueSelected = false;
                    }).catch(function (error) {
                        console.log(error);
                    });
                    this.loadProductAttributes(this.productid);
                }
            },
            deleteProductAttribute(pa) {
                let _this = this;
                this.$swal({
                    title: "Você tem certeza?",
                    text: "Uma vez removido, você não terá mais como recuperar o valor do atributo!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        console.log(pa.id);
                        axios.post('/admin/products/attributes/delete', {
                            id: pa.id,
                        }).then (function (response) {
                            if (response.data.status === 'success') {
                                _this.$swal("Sucesso! Atributo do produto foi removido com sucesso!", {
                                    icon: "Success",
                                });
                                this.loadProductAttributes(this.productid);
                            } else {
                                _this.$swal("O atributo do produto não foi removido.");
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else {
                        this.$swal("Ação cancelada.");
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>

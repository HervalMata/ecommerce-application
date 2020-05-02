<template>
    <div id="">
        <div class="tile">
            <h3 class="tile-title">Valores dos Atributos</h3>
            <hr>
            <div class="tile-body">
                <div class="form-group">
                    <label class="control-label" for="value">Valor</label>
                    <input
                        class="form-control"
                        type="text"
                        placeholder="Enter attribute value"
                        id="value"
                        name="value"
                        v-model="value"
                    />
                </div>
                <div class="form-group">
                    <label class="control-label" for="price">Preço</label>
                    <input
                        class="form-control"
                        type="number"
                        placeholder="Enter attribute value price"
                        id="price"
                        name="price"
                        v-model="price"
                    />
                </div>
            </div>
            <div class="tile-footer">
                <div class="row d-print-none mt-2">
                    <div class="col-12 text-right">
                        <button class="btn btn-success" type="submit" @click.stop="saveValue()" v-if="addValue">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar
                        </button>
                        <button class="btn btn-success" type="submit" @click.stop="updateValue()" v-if="!addValue">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Atualizar
                        </button>
                        <button class="btn btn-primary" type="submit" @click.stop="reset()" v-if="!addValue">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile">
            <h3 class="tile-title">Opções de Valores</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-center">
                                <th> # </th>
                                <th> Valor </th>
                                <th> Preço </th>
                                <th> Ações </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="value in values">
                                <td style="width: 25%;" class="text-center">{{ value.id }}</td>
                                <td style="width: 25%;" class="text-center">{{ value.value }}</td>
                                <td style="width: 25%;" class="text-center">{{ value.price }}</td>
                                <td style="width: 25%;" class="text-center">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger">
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
        name: "attribute-values",
        props: ['attributeid'],
        data() {
            return {
                values: [],
                value: '',
                price: '',
                currentId: '',
                addValue: true,
                key: 0,
            }
        },
        created: function() {
            this.loadValues();
        },
        methods: {
            loadValues() {
                let attributeId = this.attributeid;
                let _this = this;
                axios.post('/admin/attributes/get-values', {
                    id: attributeId
                }).then(function (response) {
                    _this.values = response.data;
                }).catch(function (error) {
                    console.log(error);
                })
            },
            saveValue() {
                if (this.value === '') {
                    this.$swal("Erro, Valor do atributo é requerido.", {
                        icon: "error",
                    });
                } else {
                    let attributeId = this.attributeId;
                    let _this = this;
                    axios.post('/admin/attributes/add-values', {
                        id: attributeId,
                        value: _this.value,
                        price: _this.price,
                    }).then(function (response) {
                        _this.values.push(response.data);
                        _this.resetValue();
                        _this.$swal("Sucesso! Valor adicionado com sucesso!", {
                            icon: "Success",
                        });
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            editAttributeValue(value) {
                this.addValue = false;
                this.value = value.value;
                this.price = value.price;
                this.currentId = value.id;
                this.key = this.values.indexOf(value);
            },
            updateValue() {
                if (this.value === '') {
                    this.$swal("Erro, Valor do atributo é requerido.", {
                        icon: "error",
                    });
                } else {
                    let attributeId = this.attributeId;
                    let _this = this;
                    axios.post('/admin/attributes/update-values', {
                        id: attributeId,
                        value: _this.value,
                        price: _this.price,
                        valueId: _this.currentId
                    }).then(function (response) {
                        _this.values.splice(_this.key, 1);
                        _this.resetValue();
                        _this.values.push(response.data);
                        _this.$swal("Sucesso! Valor atualizado com sucesso!", {
                            icon: "Success",
                        });
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            deleteAttributeValue(value) {
                this.$swal({
                    title: "Você tem certeza?",
                    text: "Uma vez removido, você não terá mais como recuperar o valor do atributo!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        this.currentId = value.id;
                        this.key = this.values.indexOf(value);
                        let _this = this;
                        axios.post('/admin/attributes/delete-values', {
                            id: _this.currentId
                        }).then (function (response) {
                            if (response.data.status === 'success') {
                                _this.values.splice(_this.key, 1);
                                _this.resetValue();
                                _this.$swal("Sucesso! Valor foi removido com sucesso!", {
                                    icon: "Success",
                                });
                            } else {
                                _this.$swal("Valor não foi removido.");
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else {
                        this.$swal("Valor não foi removido.");
                    }
                });
            },
            resetValue() {
                this.value = '';
                this.price = '';
            },
            reset() {
                this.addValue = true;
                this.resetValue();
            }
        }
    }
</script>

<style scoped>

</style>

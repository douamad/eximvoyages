<template>
    <div class="row">
        <!-- Basic Table -->
        <div class="col-sm-12">

            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <h3 class="text-muted">Listes des articles</h3>
                        <form action="#">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="articles">Article</label>
                                    <select name="articles" id="articles" class="form-control" v-model="selectedArtId" >
                                        <option v-for="option in articleOptions" v-bind:value="option.value"> {{ option.text }} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10" for="unite">Quantites</label>
                                    <input type="number" id="unite" name="unite" class="form-control" placeholder="Infos complementaires">
                                </div>
                            </div>
                         </div>

                        </form>

                        <button class="btn btn-primary" @click="setArticlesSelect()" type="button">Ajouter</button>
                        <button class="btn btn-primary" @click="addArticle()" type="button">Ajouter</button>
                        <div class="table-wrap mt-40">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Article</th>
                                        <th>Prix</th>
                                        <th>Unite</th>
                                        <th>Totale</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Reservation</td>
                                        <td>250000</td>
                                        <td>2</td>
                                        <td>500000</td>
                                        <td class="text-nowrap"><a href="#" class="mr-25" data-toggle="tooltip" data-original-title="Modifer"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="#" data-toggle="tooltip" data-original-title="Supprimer"> <i class="fa fa-close text-danger"></i> </a> </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Basic Table -->
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                edit: false,
                listSelectedArticles: [],
                articleOptions: [],
                listStoredArticles: [],
                article: {
                    id: '',
                    code: '',
                    libelle: '',
                    description: '',
                    type: '',
                    categorie: '',
                    prix: 0,
                },
                selectedArtId: 0,
                articleToAdd:{
                    artSeleted: this.article,
                    qte: 0
                }

            };
        },
        ready: function () {
            this.setArticlesSelect();
        },
        methods: {
            setArticlesSelect: function () {
                this.$http.get('http://localhost:8000/api/articles').then(function (response) {
                    this.listStoredArticles = [];
                    for(let i in response.data.data)
                    {
                        this.listStoredArticles.push(response.data.data[i]);
                        this.articleOptions.push(
                            {
                                text: response.data.data[i].libelle,
                                value: response.data.data[i].id
                            }
                        )
                    }
                });

            },
            addArticle: function () {
                this.articleToAdd.artSeleted = this.listStoredArticles[this.selectedArtId];
                this.articleToAdd.qte = 10;
                this.listSelectedArticles.push(this.articleToAdd);

            },

        }
    }
</script>
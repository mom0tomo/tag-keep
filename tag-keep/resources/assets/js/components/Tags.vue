<template>
  <div class="wrapper">
    <section class="container-top">
      <p class="text-center">Tag Keep</p>
      <!-- <p class="text-right">please <router-link to="/login">Login.</router-link></p> -->
      <div class="form-group">
        <div class="alert alert-danger" role="alert" v-if="showAlert">
          {{ alertMessage }}
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <input type="text" class="tk-title" v-model="title" @keyup.enter="addTag" placeholder="Title">
          </div>
          <div class="panel-body">
            <div>
              <input type="text" class="tk-content" v-model="content" @keyup.enter="addTag" placeholder="Take a note...">
            </div>
            <div class="tk-icons col-xs-8">
              <a><i class="fa fa-hand-o-up" aria-hidden="true"></i></a>
              <a><i class="fa fa-user-plus" aria-hidden="true"></i></a>
              <a><i class="fa fa-paint-brush" aria-hidden="true"></i></a>
              <a><i class="fa fa-picture-o" aria-hidden="true"></i></a>
              <a @click="removeTag(tag)"><i class="fa fa-archive" aria-hidden="true"></i></a>
              <a><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
              <a><i class="fa fa-undo" aria-hidden="true"></i></a>
              <a><i class="fa fa-repeat" aria-hidden="true"></i></a>
            </div>
            <div class="tk-submit col-xs-4">
              <a>DONE</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="container-bottom">
      <div v-for="tag in tags">
        <div class="col-md-4">
          <div　class="panel panel-default">
            <div class="panel-heading">
              {{ tag.title }}}
            </div>
            <div class="panel-body">
              <div>
                {{ tag.content }}
              </div>
              <div class="tk-remove">
                <a @click="removeTag(tag)"><i class="fa fa-archive" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
  import http from '../services/http'

  export default {
    mounted() {
      this.fetchTags()
    },
    data() {
      return {
        tags: [],
        content: '',
        showAlert: false,
        alertMessage: '',
      }
    },
    methods: {
      fetchTags () {
        // TODO: not to send request when the user is not authenticated
        http.get('tags', res => {
          this.tags = res.data
        })
      },
      addTag () {
        if (this.content === '') {
          this.showAlert = true
          this.alertMessage = 'Tag content should not be blank.'
          return false
        }
        http.post('tags', {content: this.content}, res => {
          this.tags[res.data.id] = res.data
          this.content = ''
          this.showAlert = false
          this.alertMessage = ''
        })
      },
      completeTag (tag) {
        http.put('tags/' + tag.id, {is_done: !tag.is_done}, res => {
          this.tags[tag.id] = res.data
          this.$forceUpdate()
        })
      },
      removeTag (tag) {
        http.delete('tags/' + tag.id, {}, () => {
          delete this.tags[tag.id]
          this.$forceUpdate()
        })
      },
    }
  }
</script>
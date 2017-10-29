<template>
  <div>
    please <router-link to="/login">Login.</router-link>

    <div>
      <p>Your tags here.</p>

      <div class="form-group">
        <div class="alert alert-danger" role="alert" v-if="showAlert">
          {{ alertMessage }}
        </div>
        <input type="text" class="form-control"
            v-model="name" @keyup.enter="addTag" placeholder="new tag...">
        <button class="btn btn-primary add-tag-btn" disabled="disabled" v-if="name === ''">
          Add tag
        </button>
        <button class="btn btn-primary add-tag-btn" @click='addTag' v-else>
          Add tag
        </button>
      </div>

      <ul v-for="tag in tags">
        <li v-if="tag.is_done">
          <strike> {{ tag.name }} </strike>
        </li>
        <li v-else>
          {{ tag.name }}
        </li>
        <button @click="completeTag(tag)" class="btn btn-sm btn-success" v-if="tag.is_done">Undo</button>
        <button @click="completeTag(tag)" class="btn btn-sm btn-success" v-else>Done</button>

        <button @click="removeTag(tag)" class="btn btn-sm btn-danger">Remove</button>
      </ul>

    </div>
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
        name: '',
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
        if (this.name === '') {
          this.showAlert = true
          this.alertMessage = 'Tag name should not be blank.'
          return false
        }
        http.post('tags', {name: this.name}, res => {
          this.tags[res.data.id] = res.data
          this.name = ''
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
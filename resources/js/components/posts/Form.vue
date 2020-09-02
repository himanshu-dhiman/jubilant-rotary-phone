<template>
	<div>
		<el-form ref="form" :model="post" label-width="120px">
		  <el-form-item label="Activity name">
		    <el-input v-model="post.title"></el-input>
		  </el-form-item>
		  <el-form-item label="Activity name">
		    <el-input type="textarea" rows="8" v-model="post.content"></el-input>
		  </el-form-item>
		  <el-form-item label="Activity name">
		    <el-switch v-model="post.published"></el-switch>
		  </el-form-item>
		</el-form>

		<el-button type="primary" @click="updatePost()" v-if="$route.params.slug">Update</el-button>
		<el-button type="primary" @click="createPost()" v-else>Create</el-button>
	</div>
</template>

<script>
	
	export default {
		data() {
			return {
				post: {
					title: null,
					content: null,
					published: false
				},
			}
		},

		mounted() {
			if (this.$route.params.slug) {
				this.getPost();
			}
		},

		methods: {
			getPost() {
				axios
				.get("api/blogs/"+ this.$route.params.slug)
				.then(response => {
					this.post.title = response.data.data.title;
					this.post.content = response.data.data.content;
					this.post.published = (response.data.data.published) ? true : false;
				});
			},

			createPost() {
				let payload = this.preparePayload();

				axios
				.post("api/blogs/", payload)
				.then(response => {
					this.$router.push({name:"home"});
				});
			},

			updatePost() {

				let payload = this.preparePayload();

				axios
				.put("api/blogs/"+ this.$route.params.slug, payload)
				.then(response => {
					this.$router.push({name:"home"});
				});
			},

			preparePayload() {
				let payload = {
					title : this.post.title,
					content : this.post.content,
					published : this.post.published,
				}

				return payload;
			}

		}
	}

</script>
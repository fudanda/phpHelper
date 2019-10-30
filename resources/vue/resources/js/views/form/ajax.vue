<template>
   <!-- <a-input  :value="value" placeholder="输入链接"/> -->
    <div>
    <a-button type="primary" @click="ajax1">签到</a-button>
    <a-button type="primary" >抽奖</a-button>
    </div>


</template>

<script>
import axios from 'axios'

import {article} from '@/api/graphql';
import gql from 'graphql-tag'
export default {
  name: 'BaseForm',
  data () {
    return {
        value1:'http://www.sarlboroapp.com/app/index.php?act=sign&op=add_sign&timestamp=1558600006&sign=efbb37e08cd214456bc2fd67c2bab936&token=hkp7kcXQfj0MgH-R4h6gK26SPOe4u40ZUzqmK5a3EGl3UJRodCiZaJPaZId8YDgZUbSwDA1U3a-fYh-zE4En2aHkW7LY7w5j0lAeAUQtWk7iJgRfq8yklOQwlGW==e10adc3949ba59abbe56e057f20f883e',
        value2:'http://www.sarlboroapp.com/app/index.php?act=lottery&op=participate&timestamp=1558600044&sign=c197cff13f3ed19b7f997d8d3c1187b4&token=hkp7kcXQfj0MgH-R4h6gK26SPOe4u40ZUzqmK5a3EGl3UJRodCiZaJPaZId8YDgZUbSwDA1U3a-fYh-zE4En2aHkW7LY7w5j0lAeAUQtWk7iJgRfq8yklOQwlGW==e10adc3949ba59abbe56e057f20f883e',
    }
  },
  methods: {
   
    ajax1 (e) {
      this.$apollo.mutate({
      // Query
      mutation: gql`mutation{
        article{
         article_id
        }
      }`,
      // Parameters
      variables: {
        label: this.newTag,
      }
}).then(data=>{
    console.log(data)
}).catch(error=>{
    console.log(error)
})
      
    },
   
  }
}
</script>

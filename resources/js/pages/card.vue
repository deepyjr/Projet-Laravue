<template>
    <div>
    <CRow>
      <CCol sm="6">
        <CCard>
          <CCardHeader>
            {{status}}
          </CCardHeader>
          <CCardBody>
            Test
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  <br>
  </div>
</template>

<script>
export default {
  props:['status'],
  data(){
    return{

    }
  }
  
}
</script>
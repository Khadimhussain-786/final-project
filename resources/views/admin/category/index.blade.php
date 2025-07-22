@extends('layouts.adminLayouts')

@section('content')
<div class="row justify-content-center" style="margin: 30px 0;">
    <section class="col-lg-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">
                <h3>اضافه کردن دسته</h3>
            </div>
            <div class="custom-panel-body">

                
               
                <div class="form-group mb-4">
                     <div class="panel-heading"><h3 style="margin: 0;"> حذف دسته </h3></div>
                     <div style="width: 90%; margin:auto;">
                        <select class="form-control" v-model="p_id">
                        <option>انتخاب دسته</option>

                           <option v-for="category in categorys" :value="category.id">@{{ category.name }}</option>
            


                                      
                        </select>
                        <button class="btn btn-danger w-100 mt-2" @click="deleteCategory()">حذف دسته</button>
                     </div>
                   
                </div>
          
                <hr>

                
                <div class="form-group mb-4">
                    <div class="panel-heading"><h3 style="margin: 0;">افزودن زیر دسته</h3></div>
                      <div style="width: 90%; margin:auto;">
                            <input type="text" class="form-control mb-2" placeholder="نام زیر دسته را وارد کنید..." v-model="NameCategory">
                            <select class="form-control" v-model="parent_id">
                                   <option data-display="دسته اصلی" value="0" selected>دسته اصلی</option>
                            
                                      <option v-for="category in categorys" :value="category.id">@{{ category.name }}</option>
            

                                        
                            </select>
                            <button class="btn btn-info w-100 mt-2" style="left: 0;" @click="addCategory()" >ذخیره دسته</button>
                      </div>
                        
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

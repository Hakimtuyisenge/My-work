from django.contrib import admin
from .models import Post, Category, Testimonial
from django_summernote.admin import SummernoteModelAdmin

class PostAdmin(SummernoteModelAdmin):
     summernote_fields = ('body',)
admin.site.register(Post, PostAdmin)
admin.site.register(Category)
admin.site.register(Testimonial)

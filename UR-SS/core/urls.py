from django.urls import path
from core.views import *

urlpatterns = [
    path('', LandingPageView.as_view(), name = 'landing'),
    path('register', clientRegister, name = 'client-register'),
    path('login', clientLogin, name = 'client-login'),
    path('logout', logoutuser, name = 'client-logout'),
    path('categories/', CategoriesView.as_view(), name = 'categories'),
    path('posts/', ClientPostView.as_view(), name = 'client-posts'),
    path('category-posts/<str:cats>/', CategoryPostView, name = 'category-posts'),
    path('post-detail/<slug:slug>', PostDetailView.as_view(), name = 'client-post-detail'),
    path('feedback', FeedbackView.as_view(), name = 'client-feedback'),
    path('confirm-payment/<int:pk>', confirm_payment, name='add'),
    path('confirm-category-payment/<int:pk>', confirm_payment_category, name = "add_category"),
    
    # Author urls  
    path('home/', HomePageView.as_view(), name = 'home'),
    path('terms-conditions/', TermsView.as_view(), name = 'terms'),
    path('new-post', NewPostView.as_view(), name = 'new-post'),
    path('post-list', PostListView.as_view(), name ='post-list'),
    path('paid-posts', PaidPostListView.as_view(), name ='paid-post'),
    path('unpaid-post', UnpaidPostListView.as_view(), name ='unpaid-post'),
    path('profile', ProfileView.as_view(), name ='profile'),    
                                         
]
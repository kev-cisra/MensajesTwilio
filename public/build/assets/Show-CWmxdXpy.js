import{_ as c}from"./AppLayout-DNnUb5Z2.js";import p from"./DeleteUserForm-FxfFQEEy.js";import l from"./LogoutOtherBrowserSessionsForm-DBCUL6eS.js";import{S as s}from"./SectionBorder-Cj_xvMJq.js";import f from"./TwoFactorAuthenticationForm-scr1zi64.js";import u from"./UpdatePasswordForm-DlJGVZOH.js";import _ from"./UpdateProfileInformationForm-D8OPYwVZ.js";import{o,c as d,w as n,a as i,e as r,b as t,f as a,F as h}from"./app-sSqXdj6u.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./DialogModal-iV0cPeXU.js";import"./SectionTitle-BIbxKyPy.js";import"./DangerButton-AXj_Hv-Q.js";import"./TextInput-CZg6WCSz.js";import"./SecondaryButton-CuShlsM2.js";import"./ActionMessage-C8cHzZmX.js";import"./PrimaryButton-C5llYs_R.js";import"./InputLabel-BntXQvIk.js";import"./FormSection-CEKfpkD_.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},z={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,x)=>(o(),d(c,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",w,[t(_,{user:e.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),r(h,{key:3},[t(s),t(p,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{z as default};

import{k as g,s as w,u as k,a as S,o,c as n,b as t,f,e as s,n as C,l as a,F as v,i as j,j as i,t as l,r as H}from"./app.b5f93124.js";/* empty css            */const N={class:"block justify-center items-center"},A={class:"px-12"},P={class:"pt-5 flex justify-between"},V=t("div",null,[t("h1",null,"My HubSpot hubs"),s(),t("div",{class:"subtext"},"HubSpot hubs currently connected to your team.")],-1),B={href:"/hs-auth",class:"btn hubspot flex items-center"},T={class:"block justify-center items-center p-4 mx-4 mt-4 mb-6"},F={class:"block px-4 my-5 w-100"},q={key:0,class:"flex flex-wrap -mx-1 lg:-mx-4"},z={class:"p-6 card relative"},D=t("div",{class:"card-gradient-teal"},null,-1),E={class:"relative"},I={class:"flex mb-8"},L={class:"px-4 flex whitespace-nowrap text-ellipsis overflow-hidden"},M={class:"text-white text-xl"},R=t("div",{class:"border-b-2 border-[#707A9C] mb-8"},null,-1),U={class:"mb-4 text-lg font-semibold tracking-tight text-white"},Y=t("span",{class:"muted pr-2"},"Hub id:",-1),$={class:"mb-4 text-lg font-semibold tracking-tight text-white whitespace-nowrap overflow-hidden"},G=t("span",{class:"muted pr-2"},"Authenticated by:",-1),J={class:"mb-2 pt-6 font-normal"},K=["onClick"],O={key:1,class:"py-3 muted"},Q={key:1,class:"flex justify-center items-center"},W=t("div",null,[t("h1",{class:"mb-8 text-3xl text-center"}," No connected HubSpot portals "),t("p",{class:"text-center subtext"},[s(" You don't have any portals connected to this team. "),t("a",{href:"/hs-auth",class:""},"Add one now"),s("."),t("br"),t("br"),s(" This sample app only requires a single scope "),t("strong",null,"crm.lists.read"),s(". "),t("br"),s("It cannot read your contacts and has "),t("strong",null,"no writing priveleges"),s(". ")])],-1),X=[W],nt={__name:"Portals",setup(Z){const r=g(),{portals:c}=w(r),d=k();r.fetchPortals();async function y(h){await axios.post(route("portals.alias-as"),h),H.push("/hs/lists")}return(h,tt)=>{var _,p,m;const u=S("font-awesome-icon");return o(),n(v,null,[t("div",N,[t("div",A,[t("div",P,[V,t("div",null,[t("a",B,[f(u,{icon:"fa-brands fa-hubspot",class:"pr-0 text-xl text-white mr-2"}),s(" Connect a HubSpot hub")])])])])]),t("div",T,[t("div",{class:C(["min-h-[50vh]",(_=a(c))!=null&&_.length?"":"flex justify-center items-center"])},[t("div",F,[(p=a(c))!=null&&p.length?(o(),n("div",q,[(o(!0),n(v,null,j(a(c),e=>{var b,x;return o(),n("div",{class:"my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3",key:e.id},[t("div",z,[D,t("div",E,[t("div",I,[f(u,{icon:"fa-brands fa-hubspot",class:"pr-0 text-3xl text-[#ff7a59]"}),t("div",L,[t("h3",M,l(e.hub__domain),1)])]),R,t("h5",U,[Y,s(" "+l(e.hub__id),1)]),t("h5",$,[G,s(" "+l(e.hub__user_email),1)]),t("div",J,[((b=a(d).hub)==null?void 0:b.id)!=e.id?(o(),n("a",{key:0,href:"javascript:void(0)",class:"btn",onClick:st=>y(e)},"Use this hub",8,K)):i("",!0),((x=a(d).hub)==null?void 0:x.id)==e.id?(o(),n("div",O," Currently active portal ")):i("",!0)])])])])}),128))])):i("",!0),(m=a(c))!=null&&m.length?i("",!0):(o(),n("div",Q,X))])],2)])],64)}}};export{nt as default};
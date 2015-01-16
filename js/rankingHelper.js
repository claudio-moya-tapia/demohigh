/** 
 * @function RankingHelper
 * */
var RankingHelper = {
    rankingTotal: [],
    rankingArea: [],
    rankingPais: [],
    rankingGrupos: [],
    rankingAmigos: [],
    rankingGanadoresArea: [],
    title: '',
    strUser: '',
    betweenBottom: 0,
    betweenTop: 0,
    tituloEmpresa: '',
    tituloPais: '',
    tituloArea: '',
    showTodos: false,
    showPais: false,
    showArea: false,
    showGrupos: false,
    isOctavos: false,
    create: function(type) {

        if (this.rankingTotal.length == 0) {
            this.setRankings();
        }

        if (this.tituloPais == '') {
            this.setShow();
        }

        var title = '';
        var btnAddFriend = '';
        switch (type) {
            case 'todos':
                title = this.tituloEmpresa;
                break;
            case 'todos_area':
                title = this.tituloArea;
                break;
            case 'area':
                title = this.tituloArea;
                break;
            case 'pais':
                title = this.tituloPais;
                break;
            case 'grupos':
                title = this.tituloEmpresa;
                break;
            case 'amigos':
                title = 'Ranking Amigos';
                if (!Config.isMobile) {
                    btnAddFriend = '<div class="btn-agregar"><a href="' + Config.baseUrl + '/buscar">Agregar amigos</a></div>';
                }

                break;
        }

        this.title = btnAddFriend + '<h1>' + title + '</h1>';
        this.strUser = '';
        this.betweenBottom = 0;
        this.betweenTop = 0;
    },
    /* @param {UsuarioModel} usuarioModel */
    setUser: function(usuarioModel, cssSize) {

        var cssTu = '';
        var cssPos = '';

        if (cssSize == 'big') {
            cssPos = 'pos';

            if (usuarioModel.usuario_id == Config.user.id) {
                cssTu = 'tu';
            }

        } else {
            cssPos = 'pos2';

            if (usuarioModel.usuario_id == Config.user.id) {
                cssTu = 'tu2';
            }
        }

        var tpl = '';

        if (Config.isMobile) {

            tpl += '<div class="pos">';
            tpl += '<div class="text">';
            tpl += '<p>' + usuarioModel.nombre + ' ' + usuarioModel.apellido_paterno + '<br>';
            tpl += '<span>' + usuarioModel.total_puntos + ' puntos<br>' + usuarioModel.total_plenos + ' plenos</span>';
            tpl += '</p>';
            tpl += '</div>';
            tpl += '<div class="ci">';
            tpl += '<a href="' + Config.baseUrl + '/mobile">';
            tpl += '<img src="' + Config.baseUrlImg + usuarioModel.imagen + '" alt="Perfil">';
            tpl += '</a>';
            tpl += '</div>';
            tpl += '<div class="lugar">' + usuarioModel.posicion + '</div>';
            tpl += '</div><div class="clear"></div>';

        } else {

            tpl += '<div class="' + cssPos + '">';
            tpl += '<p class="tit">' + usuarioModel.nombre + ' ' + usuarioModel.apellido_paterno + '</p>';
            tpl += '<p class="pts">' + usuarioModel.total_puntos + ' puntos<br>' + usuarioModel.total_plenos + ' plenos</p>';
            tpl += '<a class="' + cssTu + '" class="" href="' + Config.baseUrl + '/usuario/' + usuarioModel.usuario_id + '">';
            tpl += '<img src="' + Config.baseUrlImg + usuarioModel.imagen + '" alt="Perfil">';
            tpl += '</a>';
            tpl += '<div class="lugar">' + usuarioModel.posicion + '</div>';

            if (this.title.search('Ranking Amigos') != -1) {
                if (usuarioModel.usuario_id != Config.user.id) {
                    tpl += '<div class="btn-borrar"><input class="ranking-amigos" id="usuario_id_' + usuarioModel.usuario_id + '" alt="' + usuarioModel.nombre + ' ' + usuarioModel.apellido_paterno + '" name="yt4" type="button" value="Borrar"></div>';
                }
            }

            tpl += '</div>';
        }

        this.strUser += tpl;

        return cssTu;
    },
    setRankings: function() {

        var usuarioModel = new UsuarioModel();
        var i = 0;
        var posTotal = 1;
        var posArea = 1;
        var posPais = 1;
        var posGrupos = 1;
        var posAmigos = 1;
        var posAreaUEN = 1;

        if (this.isOctavos) {         
            jsonRankingTotal = jsonRankingOctavos;
        }

        for (i in jsonRankingTotal) {
            usuarioModel = new UsuarioModel();
            usuarioModel.set(jsonRankingTotal[i]);
            usuarioModel.posicion = parseInt(posTotal);

            this.rankingTotal.push(usuarioModel);

            if (jsonRankingTotal[i].ai == Config.user.ai) {
                usuarioModel = new UsuarioModel();
                usuarioModel.set(jsonRankingTotal[i]);
                usuarioModel.posicion = parseInt(posArea);
                this.rankingArea.push(usuarioModel);     
                posArea++;
            }

            if (jsonRankingTotal[i].pi == Config.user.pi) {
                usuarioModel = new UsuarioModel();
                usuarioModel.set(jsonRankingTotal[i]);
                usuarioModel.posicion = parseInt(posPais);
                this.rankingPais.push(usuarioModel);
                posPais++;
            }

            if (jsonRankingTotal[i].ei == 2) {
                usuarioModel = new UsuarioModel();
                usuarioModel.set(jsonRankingTotal[i]);
                usuarioModel.posicion = parseInt(posGrupos);
                this.rankingGrupos.push(usuarioModel);
                posGrupos++;
            }

            posTotal++;
        }

        if (Config.project == 'cristal') {

           if(!this.isOctavos){

                //Config.user.ai = 24; //23 => 35
                /** QUITAR CAMBIO DE NOMBRE POR TU **/

//            //Calculo de ganadores
//            var aryUEN = new Array();
//            var aryUENuser = new Array();
//
//            for (var k = 23; k < 36; k++) {
//                aryUENuser = new Array();
//                for (i in jsonRankingTotal) {
//                    if (jsonRankingTotal[i].ai == k) {
//                        usuarioModel = new UsuarioModel();
//                        usuarioModel.set(jsonRankingTotal[i]);
//                        usuarioModel.posicion = parseInt(posAreaUEN);
//                        aryUENuser.push(usuarioModel);
//                        posAreaUEN++;
//
//                        if (posAreaUEN == 4) {
//                            break;
//                        }
//                    }
//                }
//
//                aryUEN[k] = aryUENuser;
//                posAreaUEN = 1;
//            }
//            
//            //Generador de ganadores
//            document.writeln('var rankingAreaUEN = new Array();<br>');
//            document.writeln('var aryUserAreaUEN = new Array();<br>');
//            
//            for (var k = 23; k < 36; k++) {
//                
//                var aryUENUser = aryUEN[k];
//                
//                for(var j in aryUENUser){
//                    
//                    usuarioModel = new UsuarioModel();                
//                    usuarioModel = aryUENUser[j];
//
//                    document.writeln('usuarioModel = new UsuarioModel();<br>');
//                    document.writeln('usuarioModel.amigos_usuario_id = "'+usuarioModel.amigos_usuario_id+'";<br>');
//                    document.writeln('usuarioModel.apellido_paterno = "'+usuarioModel.apellido_paterno+'";<br>');
//                    document.writeln('usuarioModel.area_id = "'+usuarioModel.area_id+'";<br>');
//                    document.writeln('usuarioModel.empresa_id = "'+usuarioModel.empresa_id+'";<br>');
//                    document.writeln('usuarioModel.imagen = "'+usuarioModel.imagen+'";<br>');
//                    document.writeln('usuarioModel.nombre = "'+usuarioModel.nombre+'";<br>');
//                    document.writeln('usuarioModel.posicion = '+usuarioModel.posicion+';<br>');
//                    document.writeln('usuarioModel.total_plenos = "'+usuarioModel.total_plenos+'";<br>');
//                    document.writeln('usuarioModel.total_puntos = "'+usuarioModel.total_puntos+'";<br>');
//                    document.writeln('usuarioModel.usuario_id = "'+usuarioModel.usuario_id+'";<br>');
//                    document.writeln('usuarioModel.usuario_pais_id = "'+usuarioModel.usuario_pais_id+'";<br><br>');
//                    
//                    document.writeln('aryUserAreaUEN.push(usuarioModel);<br><br>');
//                }
//                
//                document.writeln('rankingAreaUEN['+k+'] = aryUserAreaUEN;<br><br>');
//                document.writeln('aryUserAreaUEN = new Array();<br>');
//            }
//             
//            document.writeln('this.rankingArea = new Array();<br>');
//            document.writeln('this.rankingArea = rankingAreaUEN[Config.user.ai];<br>');
//            document.writeln('this.tituloArea = "Ganadores Fase Grupos UEN";<br>');        

                var rankingAreaUEN = new Array();
                var aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Horta";
                usuarioModel.area_id = "23";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-8.jpg";
                usuarioModel.nombre = "Marcelo";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "7";
                usuarioModel.total_puntos = "120";
                usuarioModel.usuario_id = "100";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "53,2936,49,134,55,69";
                usuarioModel.apellido_paterno = "Veliz";
                usuarioModel.area_id = "23";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-6.jpg";
                usuarioModel.nombre = "Luis";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "3";
                usuarioModel.total_puntos = "120";
                usuarioModel.usuario_id = "87";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Lillo";
                usuarioModel.area_id = "23";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-4.jpg";
                usuarioModel.nombre = "Francisco";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "4";
                usuarioModel.total_puntos = "115";
                usuarioModel.usuario_id = "49";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[23] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Ceresa";
                usuarioModel.area_id = "24";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/16/2014_06_16_09_22_37__997355.jpg";
                usuarioModel.nombre = "Maria";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "8";
                usuarioModel.total_puntos = "148";
                usuarioModel.usuario_id = "389";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Gioia";
                usuarioModel.area_id = "24";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-7.jpg";
                usuarioModel.nombre = "Nicole";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "141";
                usuarioModel.usuario_id = "428";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "486,2038";
                usuarioModel.apellido_paterno = "Sandoval";
                usuarioModel.area_id = "24";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-4.jpg";
                usuarioModel.nombre = "Francisco";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "140";
                usuarioModel.usuario_id = "275";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[24] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "690,567,715,659,411,838,1052";
                usuarioModel.apellido_paterno = "Robles";
                usuarioModel.area_id = "25";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/24/2014_06_24_14_38_48__555974.JPG";
                usuarioModel.nombre = "Ismael";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "8";
                usuarioModel.total_puntos = "142";
                usuarioModel.usuario_id = "838";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "1004,1253,789,1139,675,563";
                usuarioModel.apellido_paterno = "Poblete";
                usuarioModel.area_id = "25";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar_default.jpg";
                usuarioModel.nombre = "Jesus";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "134";
                usuarioModel.usuario_id = "862";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "1189,834,856,1211,1114,898";
                usuarioModel.apellido_paterno = "Perlwitz";
                usuarioModel.area_id = "25";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/04/2014_06_04_09_12_48__941662.jpg";
                usuarioModel.nombre = "Juan";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "8";
                usuarioModel.total_puntos = "133";
                usuarioModel.usuario_id = "934";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[25] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Mazuela";
                usuarioModel.area_id = "26";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-8.jpg";
                usuarioModel.nombre = "Ronald";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "9";
                usuarioModel.total_puntos = "142";
                usuarioModel.usuario_id = "1652";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Flores";
                usuarioModel.area_id = "26";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/20/2014_06_20_17_16_17__556770.png";
                usuarioModel.nombre = "Patricio";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "141";
                usuarioModel.usuario_id = "1613";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "1374,1577,1359";
                usuarioModel.apellido_paterno = "Bello";
                usuarioModel.area_id = "26";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/13/2014_06_13_10_55_07__242888.jpg";
                usuarioModel.nombre = "Nicole";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "8";
                usuarioModel.total_puntos = "139";
                usuarioModel.usuario_id = "1582";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[26] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Vasquez";
                usuarioModel.area_id = "27";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-8.jpg";
                usuarioModel.nombre = "Francisco";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "129";
                usuarioModel.usuario_id = "1703";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Cheuqueman";
                usuarioModel.area_id = "27";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-8.jpg";
                usuarioModel.nombre = "Antonio";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "4";
                usuarioModel.total_puntos = "127";
                usuarioModel.usuario_id = "1693";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "1725,1718,1693,1692,1699,1713,1723";
                usuarioModel.apellido_paterno = "Gonzalez";
                usuarioModel.area_id = "27";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/19/2014_06_19_09_35_02__826760.JPG";
                usuarioModel.nombre = "Carolina";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "5";
                usuarioModel.total_puntos = "125";
                usuarioModel.usuario_id = "1697";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[27] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Siburo";
                usuarioModel.area_id = "28";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/04/2014_06_04_09_43_47__427017.JPG";
                usuarioModel.nombre = "Marcel";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "0";
                usuarioModel.total_puntos = "4";
                usuarioModel.usuario_id = "1741";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[28] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "1917,1836,1825,1805,1791,1965";
                usuarioModel.apellido_paterno = "Ramirez";
                usuarioModel.area_id = "29";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-7.jpg";
                usuarioModel.nombre = "Natalia";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "135";
                usuarioModel.usuario_id = "1955";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "1955,1769,1914,1851,1831,1836,1805,1965,1917,1791,1973,1975,1976,1932,1884,1915,1861";
                usuarioModel.apellido_paterno = "Cifuentes";
                usuarioModel.area_id = "29";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-4.jpg";
                usuarioModel.nombre = "Jose";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "134";
                usuarioModel.usuario_id = "1884";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Ahumada";
                usuarioModel.area_id = "29";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar_default.jpg";
                usuarioModel.nombre = "Loreto";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "129";
                usuarioModel.usuario_id = "1918";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[29] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Cortes";
                usuarioModel.area_id = "30";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-3.jpg";
                usuarioModel.nombre = "Cristian";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "132";
                usuarioModel.usuario_id = "2032";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Valdes";
                usuarioModel.area_id = "30";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/12/2014_06_12_09_21_59__468132.JPG";
                usuarioModel.nombre = "Luis";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "4";
                usuarioModel.total_puntos = "129";
                usuarioModel.usuario_id = "2054";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Morales";
                usuarioModel.area_id = "30";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar_default.jpg";
                usuarioModel.nombre = "Fernando";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "2";
                usuarioModel.total_puntos = "126";
                usuarioModel.usuario_id = "2036";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[30] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "2136,2137,1063,2658,3541,3549,2487,2835,2270,3008,2949";
                usuarioModel.apellido_paterno = "De La Jara";
                usuarioModel.area_id = "31";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-4.jpg";
                usuarioModel.nombre = "Luis";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "5";
                usuarioModel.total_puntos = "134";
                usuarioModel.usuario_id = "2658";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Catril";
                usuarioModel.area_id = "31";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-3.jpg";
                usuarioModel.nombre = "Adolfo";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "5";
                usuarioModel.total_puntos = "132";
                usuarioModel.usuario_id = "2078";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "2936,2422,3018,3039,2988,2330,2263,2910,2919";
                usuarioModel.apellido_paterno = "Zamora";
                usuarioModel.area_id = "31";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-7.jpg";
                usuarioModel.nombre = "Maria";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "2";
                usuarioModel.total_puntos = "132";
                usuarioModel.usuario_id = "2758";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[31] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Contreras";
                usuarioModel.area_id = "32";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/20/2014_06_20_09_07_54__331897.";
                usuarioModel.nombre = "Jonatan";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "8";
                usuarioModel.total_puntos = "135";
                usuarioModel.usuario_id = "3125";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "3192,3149,2414,3215,3199,3145,378,3088,3121,3193,3189,3093";
                usuarioModel.apellido_paterno = "Cardenas";
                usuarioModel.area_id = "32";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/06/2014_06_06_12_50_21__709653.jpg";
                usuarioModel.nombre = "Patricio";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "3";
                usuarioModel.total_puntos = "122";
                usuarioModel.usuario_id = "3193";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "222,236,417,452";
                usuarioModel.apellido_paterno = "Foncea";
                usuarioModel.area_id = "32";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/13/2014_06_13_09_31_03__909403.jpeg";
                usuarioModel.nombre = "Matias";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "5";
                usuarioModel.total_puntos = "120";
                usuarioModel.usuario_id = "3171";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[32] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Martinez";
                usuarioModel.area_id = "33";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/06/2014_06_06_23_37_35__532617.jpg";
                usuarioModel.nombre = "Armando";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "3";
                usuarioModel.total_puntos = "131";
                usuarioModel.usuario_id = "3253";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "3669,3894,2961,2337,2137,2658,3541,4228,2656,2918,2300,2239,2136";
                usuarioModel.apellido_paterno = "Bernal";
                usuarioModel.area_id = "33";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-7.jpg";
                usuarioModel.nombre = "Maria";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "5";
                usuarioModel.total_puntos = "128";
                usuarioModel.usuario_id = "3479";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Rodriguez";
                usuarioModel.area_id = "33";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-8.jpg";
                usuarioModel.nombre = "Ricardo";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "4";
                usuarioModel.total_puntos = "121";
                usuarioModel.usuario_id = "3545";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[33] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "4077,4419,4859,1078";
                usuarioModel.apellido_paterno = "Miranda";
                usuarioModel.area_id = "34";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/upload/2014/06/19/2014_06_19_18_28_54__206892.jpg";
                usuarioModel.nombre = "Jaime";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "8";
                usuarioModel.total_puntos = "137";
                usuarioModel.usuario_id = "4107";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Santibanez";
                usuarioModel.area_id = "34";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-3.jpg";
                usuarioModel.nombre = "Luis";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "6";
                usuarioModel.total_puntos = "136";
                usuarioModel.usuario_id = "4399";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "4791,4007,4349,4604";
                usuarioModel.apellido_paterno = "Ulloa";
                usuarioModel.area_id = "34";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-8.jpg";
                usuarioModel.nombre = "Juan";
                usuarioModel.posicion = 3;
                usuarioModel.total_plenos = "5";
                usuarioModel.total_puntos = "135";
                usuarioModel.usuario_id = "4285";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[34] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Arriagada";
                usuarioModel.area_id = "35";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar-4.jpg";
                usuarioModel.nombre = "Eugenio";
                usuarioModel.posicion = 1;
                usuarioModel.total_plenos = "3";
                usuarioModel.total_puntos = "112";
                usuarioModel.usuario_id = "512";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                usuarioModel = new UsuarioModel();
                usuarioModel.amigos_usuario_id = "";
                usuarioModel.apellido_paterno = "Soto";
                usuarioModel.area_id = "35";
                usuarioModel.empresa_id = "14";
                usuarioModel.imagen = "/images/avatar_default.jpg";
                usuarioModel.nombre = "Hector";
                usuarioModel.posicion = 2;
                usuarioModel.total_plenos = "0";
                usuarioModel.total_puntos = "7";
                usuarioModel.usuario_id = "516";
                usuarioModel.usuario_pais_id = "1";

                aryUserAreaUEN.push(usuarioModel);

                rankingAreaUEN[35] = aryUserAreaUEN;

                aryUserAreaUEN = new Array();
                this.rankingArea = new Array();
                this.rankingArea = rankingAreaUEN[Config.user.ai];
                this.tituloArea = "Ganadores Fase Grupos UEN";
            }
        }

        var x = 0;
        var aryAmigos = new Array();
        for (x in jsonRankingTotal) {
            usuarioModel = new UsuarioModel();
            usuarioModel.set(jsonRankingTotal[x]);

            if (usuarioModel.usuario_id == Config.user.id) {
                usuarioModel.amigos_usuario_id += ',' + Config.user.id;
                aryAmigos = usuarioModel.amigos_usuario_id.split(',');
                break;
            }
        }

        var y = 0;
        var z = 0;
        if (aryAmigos.length > 0) {

            for (z in jsonRankingTotal) {
                usuarioModel = new UsuarioModel();
                usuarioModel.set(jsonRankingTotal[z]);

                for (y in aryAmigos) {
                    if (usuarioModel.usuario_id == aryAmigos[y]) {
                        usuarioModel.posicion = parseInt(posAmigos);
                        this.rankingAmigos.push(usuarioModel);
                        posAmigos++;
                    }
                }
            }
        }

        jsonRankingTotal = null;
    },
    setList: function(start, end, ranking, cssSize, usuarioLocal) {

        var usuarioModel = new UsuarioModel();
        var i = start;
        var userFound = false;

        for (i = start; i <= end; i++) {
            usuarioModel = eval('this.' + ranking + '[' + i + '];');

            if (usuarioModel != null) {
                if (this.setUser(usuarioModel, cssSize) == 'tu') {
                    userFound = true;
                }
            }
        }

        if (!userFound) {
            this.setUser(usuarioLocal, cssSize);
        }
    },
    setListRanking: function(start, end, ranking, cssSize, usuarioLocal) {        
        var usuarioModel = new UsuarioModel();
        var i = start;
        var userFound = false;

        for (i = start; i <= end; i++) {
            usuarioModel = eval('this.' + ranking + '[' + i + '];');

            if (usuarioModel != null) {
                if (this.setUser(usuarioModel, cssSize) == 'tu') {
                    userFound = true;
                }
            }
        }

        return userFound;
    },
    searchUserRange: function(numero) {

        var betweenBottom = 0;
        var betweenTop = 0;
        var countBottom = 0;
        var findBottom = false;
        var findTop = false;
        var bottom = 0;
        var countTop = 0;
        var top = 0;

        //search user and neighbors
        if (numero < 10) {

            betweenBottom = 4;
            betweenTop = 14;
        } else {

            if (numero % 10 != 0) {
                countBottom = 0;
                findBottom = true;
                bottom = numero;
                while (findBottom) {

                    if (bottom % 10 == 0) {
                        findBottom = false;
                    } else {
                        countBottom++;
                        bottom--;
                    }
                }

                countTop = 0;
                findTop = true;
                top = numero;
                while (findTop) {

                    if (top % 10 == 0) {
                        findTop = false;
                    } else {
                        countTop++;
                        top++;
                    }
                }

                betweenBottom = (numero - countBottom);
                betweenTop = (numero + countTop);
            } else {

                betweenBottom = numero;
                betweenTop = numero + 10;
            }
        }

        this.betweenBottom = betweenBottom;
        this.betweenTop = betweenTop;
    },
    //Ranking
    setRankingTop100Area: function() {
        this.create('todos_area');
        var usuarioLocal = this.getUserPositionArea();
        this.setListRanking(0, 99, 'rankingArea', 'big', usuarioLocal);
    },
    setRankingTop100: function() {
        this.create('todos');
        var usuarioLocal = this.getUserPositionAll();
        this.setListRanking(0, 99, 'rankingTotal', 'big', usuarioLocal);
    },
    setRankingTodos: function() {
        this.create('todos');
        var usuarioLocal = this.getUserPositionAll();
        this.setListRanking(0, 2, 'rankingTotal', 'big', usuarioLocal);
        this.searchUserRange(usuarioLocal.posicion);
        this.strUser += '<div class="separador"></div>';
        this.setListRanking(this.betweenBottom - 1, this.betweenTop - 1, 'rankingTotal', 'small', usuarioLocal);
    },
    setRankingArea: function() {
        this.create('area');
        var usuarioLocal = this.getUserPositionArea();
        this.setListRanking(0, 2, 'rankingArea', 'big', usuarioLocal);
        this.searchUserRange(usuarioLocal.posicion);
        this.strUser += '<div class="separador"></div>';
        this.setListRanking(this.betweenBottom - 1, this.betweenTop - 1, 'rankingArea', 'small', usuarioLocal);
    },
    setRankingPais: function() {
        this.create('pais');
        var usuarioLocal = this.getUserPositionPais();
        this.setListRanking(0, 2, 'rankingPais', 'big', usuarioLocal);
        this.searchUserRange(usuarioLocal.posicion);
        this.strUser += '<div class="separador"></div>';
        this.setListRanking(this.betweenBottom - 1, this.betweenTop - 1, 'rankingPais', 'small', usuarioLocal);
    },
    setRankingAmigos: function() {
        this.create('amigos');
        var usuarioLocal = this.getUserPositionAmigos();
        this.setListRanking(0, 2, 'rankingAmigos', 'big', usuarioLocal);
        this.searchUserRange(usuarioLocal.posicion);
        this.strUser += '<div class="separador"></div>';
        this.setListRanking(this.betweenBottom - 1, this.betweenTop - 1, 'rankingAmigos', 'small', usuarioLocal);
    },
    getRankingTop100Area: function() {        
        this.setRankingTop100Area();
        return '<div class="caja-ranking degrade">' + this.title + this.strUser + '<div class="clear"></div></div>';
    },
    getRankingTop100: function() {
        this.setRankingTop100();
        return '<div class="caja-ranking degrade">' + this.title + this.strUser + '<div class="clear"></div></div>';
    },
    getRankingTodos: function() {
        this.setRankingTodos();
        return '<div class="caja-ranking degrade">' + this.title + this.strUser + '<div class="clear"></div></div>';
    },
    getRankingArea: function() {
        this.setRankingArea();
        return '<div class="caja-ranking degrade">' + this.title + this.strUser + '<div class="clear"></div></div>';
    },
    getRankingPais: function() {
        this.setRankingPais();
        return '<div class="caja-ranking degrade">' + this.title + this.strUser + '<div class="clear"></div></div>';
    },
    getRankingAmigos: function() {
        this.setRankingAmigos();
        return '<div class="caja-ranking degrade">' + this.title + this.strUser + '<div class="clear"></div></div>';
    },
    //Home
    setHomeTodos: function() {
        this.create('todos');
        this.setList(0, 2, 'rankingTotal', 'big', this.getUserPositionAll());
    },
    setHomeArea: function() {
        this.create('area');
        this.setList(0, 2, 'rankingArea', 'big', this.getUserPositionArea());
    },
    setHomePais: function() {
        this.create('pais');
        this.setList(0, 2, 'rankingPais', 'big', this.getUserPositionPais());
    },
    setHomeGrupos: function() {
        this.create('grupos');
        this.setList(0, 2, 'rankingGrupos', 'big', this.getUserPositionGrupos());
    },
    getHomeTodos: function() {
        this.setHomeTodos();
        this.strUser += '<div class="clear"></div>';
        return this.title + this.strUser;
    },
    getHomeArea: function() {
        this.setHomeArea();
        this.strUser += '<div class="clear"></div>';
        return this.title + this.strUser;
    },
    getHomePais: function() {
        this.setHomePais();
        this.strUser += '<div class="clear"></div>';
        return this.title + this.strUser;
    },
    getHomeGrupos: function() {
        this.setHomeGrupos();
        this.strUser += '<div class="clear"></div>';
        return this.title + this.strUser;
    },
    //Mobile
    setMobileTodos: function() {
        this.create('todos');
        this.setList(0, 2, 'rankingTotal', 'big', this.getUserPositionAll());
    },
    setMobileArea: function() {
        this.create('area');
        this.setList(0, 2, 'rankingArea', 'big', this.getUserPositionArea());
    },
    setMobilePais: function() {
        this.create('pais');
        this.setList(0, 2, 'rankingPais', 'big', this.getUserPositionPais());
    },
    setMobileAmigos: function() {
        this.create('amigos');
        this.setList(0, 2, 'rankingAmigos', 'big', this.getUserPositionAmigos());
    },
    getMobileTodos: function() {
        this.setMobileTodos();
        return '<div class="cont-rank" style="height: 355px">' + this.title + this.strUser + '</div>';
    },
    getMobileArea: function() {
        this.setMobileArea();
        return '<div class="cont-rank" style="height: 355px">' + this.title + this.strUser + '</div>';
    },
    getMobilePais: function() {
        this.setMobilePais();
        return '<div class="cont-rank" style="height: 355px">' + this.title + this.strUser + '</div>';
    },
    getMobileAmigos: function() {
        this.setMobileAmigos();
        return '<div class="cont-rank" style="height: 355px">' + this.title + this.strUser + '</div>';
    },
    //Utils
    getUserPositionAll: function() {
        var i = 0;
        var usuarioModel = new UsuarioModel();

        for (i in this.rankingTotal) {
            usuarioModel = this.rankingTotal[i];

            if (usuarioModel.usuario_id == Config.user.id) {
                usuarioModel.nombre = 'Tú';
                usuarioModel.apellido_paterno = '';
                break;
            }
        }

        return usuarioModel;
    },
    getUserPositionArea: function() {
        var i = 0;
        var usuarioModel = new UsuarioModel();

        for (i in this.rankingArea) {
            usuarioModel = this.rankingArea[i];

            if (usuarioModel.usuario_id == Config.user.id) {
                usuarioModel.nombre = 'Tú';
                usuarioModel.apellido_paterno = '';
                break;
            }
        }

        return usuarioModel;
    },
    getUserPositionPais: function() {
        var i = 0;
        var usuarioModel = new UsuarioModel();

        for (i in this.rankingPais) {
            usuarioModel = this.rankingPais[i];

            if (usuarioModel.usuario_id == Config.user.id) {
                usuarioModel.nombre = 'Tú';
                usuarioModel.apellido_paterno = '';
                break;
            }
        }

        return usuarioModel;
    },
    getUserPositionAmigos: function() {
        var i = 0;
        var usuarioModel = new UsuarioModel();

        for (i in this.rankingAmigos) {
            usuarioModel = this.rankingAmigos[i];

            if (usuarioModel.usuario_id == Config.user.id) {
                usuarioModel.nombre = 'Tú';
                usuarioModel.apellido_paterno = '';
                break;
            }
        }

        return usuarioModel;
    },
    getUserPositionGrupos: function() {
        var i = 0;
        var usuarioModel = new UsuarioModel();

        for (i in this.rankingGrupos) {
            usuarioModel = this.rankingGrupos[i];

            if (usuarioModel.empresa_id == 2) {
                if (usuarioModel.usuario_id == Config.user.id) {
                    usuarioModel.nombre = 'Tú';
                    usuarioModel.apellido_paterno = '';
                    break;
                }
            }
        }

        return usuarioModel;
    },
    setShow: function() {

        this.showGrupos = false;

        switch (Config.project) {
            case 'bbva':
                this.tituloEmpresa = 'Grupo BBVA';
                this.tituloPais = 'División';
                this.tituloArea = 'Area';
                //this.tituloMisAmigos = 'Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'santander':
                this.tituloEmpresa = 'Ranking Santander';
                this.tituloPais = '';
                this.tituloArea = 'Ranking ' + Config.user.an;
                //this.tituloMisAmigos = 'Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'skchile':
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking ' + Config.user.an;
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = false;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'cchc':
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking ' + Config.user.an;
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = false;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'afphabitat':
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking Gerencia ' + Config.user.an;
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'cristal':
                this.tituloEmpresa = 'Ranking Total CCU';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking UEN CCU';
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTwitter = false;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'credicorp':
                this.tituloEmpresa = 'Ranking Total';
                this.tituloPais = 'Ranking ' + Config.user.pn;
                this.tituloArea = 'Ranking';
                //this.tituloMisAmigos = 'Ranking Amigos';
                this.showPais = true;
                this.showArea = false;
                this.showTodos = true;
                //this.showEmpresa = false;
                break;
            case 'contract':
                this.tituloEmpresa = 'Ranking Total';
                this.tituloPais = 'Ranking ' + Config.user.pn;
                this.tituloArea = 'Ranking ' + Config.user.an;
                //this.tituloMisAmigos = 'Ranking Amigos';
                this.showPais = true;
                this.showArea = false;
                this.showTodos = true;
                //this.showEmpresa = false;
                break;
            case 'tironi':
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = '';
                this.tituloArea = 'Ranking ' + Config.user.an;
                //this.tituloMisAmigos = 'Mis Amigos';
                this.showPais = false;
                this.showArea = false;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'aesgener':
                this.tituloEmpresa = 'Ranking Empresa Aesgener';
                this.tituloPais = '';
                this.tituloArea = 'Ranking ' + Config.user.an;
                //this.tituloMisAmigos = 'Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'anden':
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking Gerencia ' + Config.user.an;
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            case 'dcv':
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking Gerencia ' + Config.user.an;
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = false;
                this.showTodos = false;
                this.showGrupos = true;
                break;
            case 'euroamerica':
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking Area';
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
            default:
                this.tituloEmpresa = 'Ranking Empresa';
                this.tituloPais = 'Ranking País';
                this.tituloArea = 'Ranking Area';
                //this.tituloMisAmigos = 'Ranking Mis Amigos';
                this.showPais = false;
                this.showArea = true;
                this.showTodos = true;
                //this.showEmpresa = true;
                break;
        }
    }
};
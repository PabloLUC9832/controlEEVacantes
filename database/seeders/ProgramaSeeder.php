<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Programa;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$programa1 = new Programa();
        $programa1->clave = 13116;
        $programa1->nombre = "HOTELERIA Y TURISMO";
        $programa1->save();

        $programa2 = new Programa();
        $programa2->clave = 13118;
        $programa2->nombre = "CARRERA DE TECNICO SUPERIOR UNIVERSITARIO EN GESTION ADUANAL";
        $programa2->save();*/

        $programa3 = new Programa();
        $programa3->clave = 14140;
        $programa3->nombre = "CONTADURIA";
        $programa3->save();

        $programa4 = new Programa();
        $programa4->clave = 14141;
        $programa4->nombre = "ADMINISTRACION";
        $programa4->save();

        $programa5 = new Programa();
        $programa5->clave = 14142;
        $programa5->nombre = "ECONOMIA";
        $programa5->save();

        $programa6 = new Programa();
        $programa6->clave = 14143;
        $programa6->nombre = "ESTADISTICA";
        $programa6->save();

        $programa7 = new Programa();
        $programa7->clave = 14144;
        $programa7->nombre = "ADMINISTRACION DE EMPRESAS TURISTICAS";
        $programa7->save();

        $programa8 = new Programa();
        $programa8->clave = 14145;
        $programa8->nombre = "INFORMATICA";
        $programa8->save();

        $programa9 = new Programa();
        $programa9->clave = 14146;
        $programa9->nombre = "SISTEMAS COMPUTACIONALES ADMINISTRATIVOS";
        $programa9->save();

        $programa10 = new Programa();
        $programa10->clave = 14147;
        $programa10->nombre = "GEOGRAFIA";
        $programa10->save();

        $programa11 = new Programa();
        $programa11->clave = 14148;
        $programa11->nombre = "GESTION Y DIRECCION DE NEGOCIOS";
        $programa11->save();

        $programa12 = new Programa();
        $programa12->clave = 14149;
        $programa12->nombre = "CIENCIAS Y TECNICAS ESTADISTICAS";
        $programa12->save();

        $programa13 = new Programa();
        $programa13->clave = 14240;
        $programa13->nombre = "CONTADURIA (SEA)";
        $programa13->save();

        $programa14 = new Programa();
        $programa14->clave = 14241;
        $programa14->nombre = "ADMINISTRACION";
        $programa14->save();

        $programa15 = new Programa();
        $programa15->clave = 14347;
        $programa15->nombre = "PUBLICIDAD Y RELACIONES PUBLICAS";
        $programa15->save();

        $programa16 = new Programa();
        $programa16->clave = 14348;
        $programa16->nombre = "RELACIONES INDUSTRIALES (CRED)";
        $programa16->save();

        $programa17 = new Programa();
        $programa17->clave = 14349;
        $programa17->nombre = "ADMINISTRACION DE NEGOCIOS INTERNACIONALES (CRED)";
        $programa17->save();

        $programa18 = new Programa();
        $programa18->clave = 14350;
        $programa18->nombre = "LICENCIATURA EN TECNOLOGIAS COMPUTACIONALES";
        $programa18->save();

        $programa19 = new Programa();
        $programa19->clave = 14351;
        $programa19->nombre = "LICENCIATURA EN REDES Y SERVICIOS DE COMPUTO";
        $programa19->save();

        $programa20 = new Programa();
        $programa20->clave = 14352;
        $programa20->nombre = "LICENCIATURA EN INGENIERIA DE SOFTWARE";
        $programa20->save();

        $programa21 = new Programa();
        $programa21->clave = 14353;
        $programa21->nombre = "CIENCIAS POLITICAS Y GESTION PUBLICA";
        $programa21->save();

        $programa22 = new Programa();
        $programa22->clave = 14354;
        $programa22->nombre = "LOGISTICA INTERNACIONAL Y ADUANAS";
        $programa22->save();

        $programa23 = new Programa();
        $programa23->clave = 14355;
        $programa23->nombre = "DIRECCION ESTRATEGICA DE RECURSOS HUMANOS";
        $programa23->save();

        $programa24 = new Programa();
        $programa24->clave = 14356;
        $programa24->nombre = "TECNOLOGIAS DE LA INFORMACION EN LAS ORGANIZACIONES";
        $programa24->save();

        $programa25 = new Programa();
        $programa25->clave = 14357;
        $programa25->nombre = "DESARROLLO DEL TALENTO HUMANO EN LAS ORG";
        $programa25->save();

        /*$programa26 = new Programa();
        $programa26->clave = 15125;
        $programa26->nombre = "ESPECIALIZACION EN ESTUDIOS DE OPINION";
        $programa26->save();

        $programa27 = new Programa();
        $programa27->clave = 15140;
        $programa27->nombre = "ESPECIALIZACION EN ADMINISTRACION DEL COMERCIO EXTERIOR";
        $programa27->save();

        $programa28 = new Programa();
        $programa28->clave = 15141;
        $programa28->nombre = "ESPECIALIZACION EN ADMINISTRACION FISCAL";
        $programa28->save();

        $programa29 = new Programa();
        $programa29->clave = 15142;
        $programa29->nombre = "ESPECIALIZACION EN AUDITORIA FINANCIERA";
        $programa29->save();

        $programa30 = new Programa();
        $programa30->clave = 15143;
        $programa30->nombre = "ESPECIALIZACION EN ECONOMIA FINANCIERA";
        $programa30->save();

        $programa31 = new Programa();
        $programa31->clave = 15144;
        $programa31->nombre = "ESPECIALIZACION EN METODOS ESTADISTICOS";
        $programa31->save();

        $programa32 = new Programa();
        $programa32->clave = 15146;
        $programa32->nombre = "ESPECIALIZACION EN INGENIERIA DE SOFTWARE";
        $programa32->save();

        $programa33 = new Programa();
        $programa33->clave = 15147;
        $programa33->nombre = "ESPECIALIZACION EN ESTUDIOS DE OPINION IMAGEN Y MERCANDO";
        $programa33->save();

        $programa34 = new Programa();
        $programa34->clave = 15148;
        $programa34->nombre = "ESPECIALISTA EN TRIBUTACION EMPRESARIAL";
        $programa34->save();

        $programa35 = new Programa();
        $programa35->clave = 16101;
        $programa35->nombre = "MAESTRIA EN CIENCIAS DE LA COMPUTACION (EXTENSION)";
        $programa35->save();

        $programa36 = new Programa();
        $programa36->clave = 16139;
        $programa36->nombre = "MAESTRIA EN DIDACTICA DE LAS CIENCIAS SOCIALES";
        $programa36->save();

        $programa37 = new Programa();
        $programa37->clave = 16140;
        $programa37->nombre = "MAESTRIA EN CIENCIAS ADMISTRATIVAS";
        $programa37->save();

        $programa38 = new Programa();
        $programa38->clave = 16146;
        $programa38->nombre = "MAESTRIA EN ESTADISTICA APLICADA";
        $programa38->save();

        $programa39 = new Programa();
        $programa39->clave = 16147;
        $programa39->nombre = "MAESTRIA EN INGENIERIA DE SOFTWARE";
        $programa39->save();

        $programa40 = new Programa();
        $programa40->clave = 16148;
        $programa40->nombre = "MAESTRIA EN AGRONEGOCIOS INTERNACIONALES";
        $programa40->save();

        $programa41 = new Programa();
        $programa41->clave = 16149;
        $programa41->nombre = "MAESTRIA EN CONTROL Y FISCALIZACION";
        $programa41->save();

        $programa42 = new Programa();
        $programa42->clave = 16150;
        $programa42->nombre = "MAESTRIA EN ADMINISTRACION FISCAL";
        $programa42->save();

        $programa43 = new Programa();
        $programa43->clave = 16151;
        $programa43->nombre = "MAESTRIA EN GESTION DE ORGANIZACIONES";
        $programa43->save();

        $programa44 = new Programa();
        $programa44->clave = 16152;
        $programa44->nombre = "MAESTRIA EN AUDITORIA";
        $programa44->save();

        $programa45 = new Programa();
        $programa45->clave = 16153;
        $programa45->nombre = "MAESTRIA EN GESTION MUNICIPAL";
        $programa45->save();

        $programa46 = new Programa();
        $programa46->clave = 16154;
        $programa46->nombre = "MAESTRIA EN TELEMATICA";
        $programa46->save();

        $programa47 = new Programa();
        $programa47->clave = 16155;
        $programa47->nombre = "MAESTRIA EN ECONOMIA AMBIENTAL Y ECOLOGICA";
        $programa47->save();

        $programa48 = new Programa();
        $programa48->clave = 16156;
        $programa48->nombre = "MAESTRIA EN SISTEMAS INTERACTIVOS CENTRADOS EN EL USUARIO";
        $programa48->save();

        $programa49 = new Programa();
        $programa49->clave = 16158;
        $programa49->nombre = "MAESTRIA EN GESTION DE RECURSOS HUMANOS, TRABAJO Y ORGANIZACIONES";
        $programa49->save();

        $programa50 = new Programa();
        $programa50->clave = 16159;
        $programa50->nombre = "MAESTRIA EN ADMINISTRACION";
        $programa50->save();

        $programa51 = new Programa();
        $programa51->clave = 16171;
        $programa51->nombre = "MAESTRIA EN CIENCIAS ALIMENTARIAS";
        $programa51->save();

        $programa52 = new Programa();
        $programa52->clave = 16173;
        $programa52->nombre = "MAESTRIA EN CIENCIAS DE LA ENFERMERIA";
        $programa52->save();

        $programa53 = new Programa();
        $programa53->clave = 16270;
        $programa53->nombre = "MAESTRIA EN DIRECCION ESTRATEGICA E INNOVACION TECNOLOGICA";
        $programa53->save();

        $programa54 = new Programa();
        $programa54->clave = 16272;
        $programa54->nombre = "MAESTRÍA EN GESTIÓN DE LAS TECNOLOGÍAS DE INFORMACIÓN EN LAS ORGANIZACIONES";
        $programa54->save();

        $programa55 = new Programa();
        $programa55->clave = 16273;
        $programa55->nombre = "MAESTRIA EN GESTION DE NEGOCIOS";
        $programa55->save();

        $programa56 = new Programa();
        $programa56->clave = 16274;
        $programa56->nombre = "MAESTRIA EN DIRECCION EMPRESARIAL";
        $programa56->save();

        $programa57 = new Programa();
        $programa57->clave = 16276;
        $programa57->nombre = "MAESTRO (A) EN ESTUDIOS TRIBUTARIOS";
        $programa57->save();

        $programa58 = new Programa();
        $programa58->clave = 16277;
        $programa58->nombre = "MAESTRÍA EN INNOVACION Y EMPRENDIMIENTO DE NEGOCIOS";
        $programa58->save();

        $programa59 = new Programa();
        $programa59->clave = 16296;
        $programa59->nombre = "MAESTRIA EN INNOVACION Y EMPRENDIMIENTO DE NEGOCIOS";
        $programa59->save();

        $programa60 = new Programa();
        $programa60->clave = 16297;
        $programa60->nombre = "MAESTRIA EN GESTION DE NEGOCIOS";
        $programa60->save();

        $programa61 = new Programa();
        $programa61->clave = 17140;
        $programa61->nombre = "DOCTORADO EN FINANZAS PUBLICAS";
        $programa61->save();

        $programa62 = new Programa();
        $programa62->clave = 17142;
        $programa62->nombre = "DOCTORADO EN ECONOMIA (EXTENSION)";
        $programa62->save();

        $programa63 = new Programa();
        $programa63->clave = 17144;
        $programa63->nombre = "DOCTORADO EN GESTION Y CONTROL";
        $programa63->save();

        $programa64 = new Programa();
        $programa64->clave = 17145;
        $programa64->nombre = "DOCTORADO EN CIENCIAS ADMINISTRATIVAS Y GESTION PARA EL DESARROLLO";
        $programa64->save();

        $programa65 = new Programa();
        $programa65->clave = 17146;
        $programa65->nombre = "DOCTORADO EN CIENCIAS DE LA COMPUTACION";
        $programa65->save();

        $programa67 = new Programa();
        $programa67->clave = 17147;
        $programa67->nombre = "DOCTORADO EN ALTA DIRECCION DE ORGANIZACIONES";
        $programa67->save();

        $programa68 = new Programa();
        $programa68->clave = 17148;
        $programa68->nombre = "INVESTIGACIONES ECONOMICAS Y SOCIALES";
        $programa68->save();

        $programa69 = new Programa();
        $programa69->clave = 18101;
        $programa69->nombre = "DIPLOMADO EN ADMINISTRACION FINANCIERA";
        $programa69->save();

        $programa70 = new Programa();
        $programa70->clave = 18110;
        $programa70->nombre = "DIPLOMADO EN INFORMATICA";
        $programa70->save();

        $programa71 = new Programa();
        $programa71->clave = 18156;
        $programa71->nombre = "DIPLOMADO EN HERRAMIENTAS ESTADISTICAS PARA EL CONTROL DE LA";
        $programa71->save();

        $programa72 = new Programa();
        $programa72->clave = 18170;
        $programa72->nombre = "DIPLOMADO EN ILUSTRACION";
        $programa72->save();

        $programa73 = new Programa();
        $programa73->clave = 18171;
        $programa73->nombre = "DIPLOMADO CURRICULUM DE HIGH SCOPE";
        $programa73->save();

        $programa74 = new Programa();
        $programa74->clave = 18172;
        $programa74->nombre = "DIPLOMADO EN MEDICINA FORENSE";
        $programa74->save();

        $programa75 = new Programa();
        $programa75->clave = 18173;
        $programa75->nombre = "DIPLOMADO EN INVESTIGACION";
        $programa75->save();

        $programa76 = new Programa();
        $programa76->clave = 18174;
        $programa76->nombre = "DIPLOMADO EN REDES DE COMPUTADORA";
        $programa76->save();

        $programa77 = new Programa();
        $programa77->clave = 18175;
        $programa77->nombre = "DIPLOMADO EN ESTADISTICA";
        $programa77->save();

        $programa78 = new Programa();
        $programa78->clave = 18183;
        $programa78->nombre = "DIPLOMADO SOBRE SANGRE Y COMPONENTES SEGUROS";
        $programa78->save();

        $programa79 = new Programa();
        $programa79->clave = 18186;
        $programa79->nombre = "DIP. EN FORMACION DE EJEC. DE EMP.INTEGRADORAS";
        $programa79->save();

        $programa80 = new Programa();
        $programa80->clave = 18187;
        $programa80->nombre = "DIPLOMADO EN MICROBIOLOGIA CLINICA";
        $programa80->save();

        $programa81 = new Programa();
        $programa81->clave = 18188;
        $programa81->nombre = "DIPLOMADO EN MULTIMEDIA";
        $programa81->save();

        $programa82 = new Programa();
        $programa82->clave = 18190;
        $programa82->nombre = "DIPLOMADO EN GESTION MUNICIPAL";
        $programa82->save();

        $programa83 = new Programa();
        $programa83->clave = 18192;
        $programa83->nombre = "DIPLOMADO EN TECNOLOGIA DE INFROMACION";
        $programa83->save();

        $programa84 = new Programa();
        $programa84->clave = 18194;
        $programa84->nombre = "DIPLOMADO EN ORTOPEDIA FUNCIONAL DE LOS MAXILARES";
        $programa84->save();

        $programa85 = new Programa();
        $programa85->clave = 18195;
        $programa85->nombre = "DIPLOMADO DE DESARROLLO DE HABILIDADES APLICADAS EN SALUD PUBLICA";
        $programa85->save();

        $programa86 = new Programa();
        $programa86->clave = 18519;
        $programa86->nombre = "CONGRESO INTERNACIONAL EN SISTEMAS COMPUTACIONALES ADMINISTRATIVOS";
        $programa86->save();

        $programa87 = new Programa();
        $programa87->clave = 18523;
        $programa87->nombre = "CONGRESO DE INVESTIGACION DE LAS CIENCIAS Y LA SUSTENTABILIDAD";
        $programa87->save();

        $programa88 = new Programa();
        $programa88->clave = 18531;
        $programa88->nombre = "CONGRESO INT.INV.CS. SUST.ACADEMICA JOURNALS 2013";
        $programa88->save();

        $programa89 = new Programa();
        $programa89->clave = 18537;
        $programa89->nombre = "CONG.INTERNACIONAL DE INVESIGACION EN LAS CIENCIAS Y SUSTENTABILIDAD (CICS) 2014";
        $programa89->save();

        $programa90 = new Programa();
        $programa90->clave = 18551;
        $programa90->nombre = "CONGRESO INTERNACIONAL DE INVESTIGACION DE LAS CIENCIAS Y SUSTENTABILIDAD 2015";
        $programa90->save();

        $programa91 = new Programa();
        $programa91->clave = 18557;
        $programa91->nombre = "INTERNACIONAL CONFERENCE ON COMPUTING SYSTEMS AND TELEMATICS-ICCSAT 2015";
        $programa91->save();

        $programa92 = new Programa();
        $programa92->clave = 18560;
        $programa92->nombre = "CONGRESO INTERNACIONAL MAUV";
        $programa92->save();

        $programa93 = new Programa();
        $programa93->clave = 18571;
        $programa93->nombre = "TALLER VIDA EN MARTE";
        $programa93->save();

        $programa94 = new Programa();
        $programa94->clave = 18574;
        $programa94->nombre = "ASAMBLEA ANFECA";
        $programa94->save();

        $programa95 = new Programa();
        $programa95->clave = 18634;
        $programa95->nombre = "DIPLOMADO EN ADMINISTRACION Y GESTION MUNICIPAL";
        $programa95->save();

        $programa96 = new Programa();
        $programa96->clave = 18636;
        $programa96->nombre = "DIPLOMADO EN TRANSICION A LAS MATEMATICAS AVANZADAS";
        $programa96->save();

        $programa97 = new Programa();
        $programa97->clave = 18655;
        $programa97->nombre = "DIPLOMADO EN GUIA DE TURISTAS";
        $programa97->save();

        $programa98 = new Programa();
        $programa98->clave = 18666;
        $programa98->nombre = "DIPLOMADO EN SISTEMAS DE GESTION DE LA CALIDAD";
        $programa98->save();

        $programa99 = new Programa();
        $programa99->clave = 18678;
        $programa99->nombre = "DIPLOMADO EN POLITICAS PUBLICAS";
        $programa99->save();

        $programa100 = new Programa();
        $programa100->clave = 18681;
        $programa100->nombre = "DIPLOMADO RENDICION DE CUENTAS";
        $programa100->save();

        $programa101 = new Programa();
        $programa101->clave = 18745;
        $programa101->nombre = "DIPLOMADO CIENCIAS DE DATOS";
        $programa101->save();

        $programa102 = new Programa();
        $programa102->clave = 26300;
        $programa102->nombre = "COORDINACION DEL PROG.EST.INT.REG.Y DES.AMERICA-EUROPA";
        $programa102->save();

        $programa103 = new Programa();
        $programa103->clave = 27112;
        $programa103->nombre = "MIGRACION Y POBREZA EN VERACRUZ";
        $programa103->save();

        $programa104 = new Programa();
        $programa104->clave = 29113;
        $programa104->nombre = "DIAG.LOCAL SOBRE LA REAL.SOC., ECO. Y CULT. LA VIOL. Y DELINC.ESTUD.DE CASO CORD";
        $programa104->save();

        $programa105 = new Programa();
        $programa105->clave = 33140;
        $programa105->nombre = "SISTEMA INTEGRAL DE INFORMACION SOBRE INSTITUCIONES DE EDUCACION";
        $programa105->save();

        $programa106 = new Programa();
        $programa106->clave = 33151;
        $programa106->nombre = "COGRESO INTERNACIONAL HORIZONTES DE LA CONTADURIA EN LAS CIENCIAS SOCIALES";
        $programa106->save();

        $programa107 = new Programa();
        $programa107->clave = 34110;
        $programa107->nombre = "BRIGADAS URBANAS DE SALUD RIO SEDEÑO ";
        $programa107->save();

        $programa108 = new Programa();
        $programa108->clave = 34200;
        $programa108->nombre = "CONVENIO UV-FAO (CDER)";
        $programa108->save();

        $programa109 = new Programa();
        $programa109->clave = 34202;
        $programa109->nombre = "CONSULTA Y SERVICIOS DE LABORATORIO";
        $programa109->save();

        $programa110 = new Programa();
        $programa110->clave = 34211;
        $programa110->nombre = "ADMINISTRANDO MI ESTANCIA";
        $programa110->save();

        $programa111 = new Programa();
        $programa111->clave = 34235;
        $programa111->nombre = "CONTENIDO PERSONAL DISC VISUAL";
        $programa111->save();

        $programa112 = new Programa();
        $programa112->clave = 34308;
        $programa112->nombre = "CONVENIO UV-ESTUDIO AYUNTAMIENTOS MARGINADOS";
        $programa112->save();

        $programa113 = new Programa();
        $programa113->clave = 34350;
        $programa113->nombre = "CONVENIO UV-DICONSA";
        $programa113->save();

        $programa114 = new Programa();
        $programa114->clave = 34381;
        $programa114->nombre = "ASISTENCIA TECNICA Y SOPORTE PARA LA OPTIMIZACION DE FLUJOS DE INFORMACION";
        $programa114->save();

        $programa115 = new Programa();
        $programa115->clave = 34419;
        $programa115->nombre = "DIAGNOSTICO SEGURIDAD XALAPA";
        $programa115->save();

        $programa116 = new Programa();
        $programa116->clave = 34430;
        $programa116->nombre = "EMPRESARIAS VERACRUZANAS IIESES";
        $programa116->save();

        $programa117 = new Programa();
        $programa117->clave = 34436;
        $programa117->nombre = "INCUBADORA DE EMPRESAS DEL IIESCA";
        $programa117->save();

        $programa118 = new Programa();
        $programa118->clave = 34465;
        $programa118->nombre = "POR UNA VIDA LIBRE DE VIOLENCIA IVM-UV";
        $programa118->save();

        $programa119 = new Programa();
        $programa119->clave = 34472;
        $programa119->nombre = "CIUDADES EMERGENTES Y SOSTENIBLES(CES)";
        $programa119->save();

        $programa120 = new Programa();
        $programa120->clave = 34475;
        $programa120->nombre = "ENCUESTA CIUDADES EMERGENTES Y SOSTENIBLES(ICES)";
        $programa120->save();

        $programa121 = new Programa();
        $programa121->clave = 34487;
        $programa121->nombre = "ESTUDIO DE OPINION PARA EL AREA LIMONARIA";
        $programa121->save();

        $programa122 = new Programa();
        $programa122->clave = 34507;
        $programa122->nombre = "EVALUACION EXTERNA AFTERSCHOOL 2015 TAMSA-UV";
        $programa122->save();

        $programa123 = new Programa();
        $programa123->clave = 34517;
        $programa123->nombre = "ENCUESTA USUARIOS DOMESTICOS SERVICIO CEMAS XALAPA (SENDAS)";
        $programa123->save();

        $programa124 = new Programa();
        $programa124->clave = 34524;
        $programa124->nombre = "AMBIENTALES HIDROLOGICOS COL UV";
        $programa124->save();

        $programa125 = new Programa();
        $programa125->clave = 34525;
        $programa125->nombre = "EVALUACION 2016 AFTERSCHOOL";
        $programa125->save();

        $programa126 = new Programa();
        $programa126->clave = 34539;
        $programa126->nombre = "ENCUESTAIVM IMPACTO CAMPAÑA 2016";
        $programa126->save();

        $programa127 = new Programa();
        $programa127->clave = 34544;
        $programa127->nombre = "PREFERENCIAS ELECTORALES VERACRUZ";
        $programa127->save();

        $programa128 = new Programa();
        $programa128->clave = 34552;
        $programa128->nombre = "UV-BANOBRAS --BID";
        $programa128->save();

        $programa129 = new Programa();
        $programa129->clave = 34556;
        $programa129->nombre = "EVAL. CONSEJOS DISTRITALES OPLE-UV";
        $programa129->save();

        $programa130 = new Programa();
        $programa130->clave = 34570;
        $programa130->nombre = "EXPEDIENTE ELECTRONICO BLOCKCHAIN";
        $programa130->save();

        $programa131 = new Programa();
        $programa131->clave = 34586;
        $programa131->nombre = "ENCUESTA AUDIENCIAS RADIO XALAPA";
        $programa131->save();

        $programa132 = new Programa();
        $programa132->clave = 34589;
        $programa132->nombre = "ENCUESTA MUJERES Y PERFILES C";
        $programa132->save();

        $programa133 = new Programa();
        $programa133->clave = 34597;
        $programa133->nombre = "ESTUDIO ENCUESTA COPAES U.V.";
        $programa133->save();

        $programa134 = new Programa();
        $programa134->clave = 34601;
        $programa134->nombre = "EXAMEN CONSEJEROS 2020-2021 OPLE UV";
        $programa134->save();

        $programa135 = new Programa();
        $programa135->clave = 35251;
        $programa135->nombre = "ESTUDIOS ENCUESTA COPAES UV";
        $programa135->save();

        $programa136 = new Programa();
        $programa136->clave = 35252;
        $programa136->nombre = "DEBATE ELECTORAL OPLE COLIMA UV";
        $programa136->save();

        $programa137 = new Programa();
        $programa137->clave = 41828;
        $programa137->nombre = "EQUIP., CREACION Y ENSEÑ.DE CONT. ACCESIBLE PARA PERSONAS CON DISCAP.VIS:UNA G.M";
        $programa137->save();

        $programa138 = new Programa();
        $programa138->clave = 43103;
        $programa138->nombre = "MEJORA DE LA CALIDAD DE LOS PROG. ACADEM. MED. EL DES. DE UN SIST. DE APRE. DIST";
        $programa138->save();

        $programa139 = new Programa();
        $programa139->clave = 44101;
        $programa139->nombre = "RED DE LABORATORIOS APOYO ACADEMICO, EXTENSION Y SERVICIOS";
        $programa139->save();

        $programa140 = new Programa();
        $programa140->clave = 46109;
        $programa140->nombre = "UTILIDAD CONVENIOS PEMEX";
        $programa140->save();

        $programa141 = new Programa();
        $programa141->clave = 47478;
        $programa141->nombre = "MEJ.PE Y CA DES ECO-ADM XAL";
        $programa141->save();

        $programa142 = new Programa();
        $programa142->clave = 47479;
        $programa142->nombre = "FOR. Y CON.CAL.EDU.DES ECO-ADM VER.";
        $programa142->save();

        $programa143 = new Programa();
        $programa143->clave = 47480;
        $programa143->nombre = "FOR.Y CON.....DES ECO-ADM COR-ORI.";
        $programa143->save();

        $programa144 = new Programa();
        $programa144->clave = 47481;
        $programa144->nombre = "FOR.Y CON......DES ECO-ADM PR-TUX.";
        $programa144->save();

        $programa145 = new Programa();
        $programa145->clave = 47493;
        $programa145->nombre = "P-INT.FOR.CAP.Y COM.DES ECO-ADM COA";
        $programa145->save();

        $programa146 = new Programa();
        $programa146->clave = 49103;
        $programa146->nombre = "ACTUALIZACION Y MODIFICACION DE LOS PLANES Y PROGRAMAS DE ESTUDIO";
        $programa146->save();

        $programa147 = new Programa();
        $programa147->clave = 49201;
        $programa147->nombre = "ADMINISTRACION, ADMON. DE EMPRESAS TURISTICAS Y CONTADURIA";
        $programa147->save();*/

    }
}

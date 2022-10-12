<?php

namespace Database\Seeders;

use App\Models\Motivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $motivo1 = new Motivo();
        $motivo1->numeroMotivo = 1;
        $motivo1->nombre = "OCUPADA NORMAL";
        $motivo1->concepto = "Para dar de ALTA a los titulares de una plaza, a los ITD, a los IOD y para reincorporar al personal al término de  cualquier motivo de separación temporal, así como los nombramientos.";
        $motivo1->save();

        $motivo2 = new Motivo();
        $motivo2->numeroMotivo = 2;
        $motivo2->nombre = "AÑO SABÁTICO";
        $motivo2->concepto = "Para dar de ALTA a los Suplentes del personal académico que disfruta de Licencia con goce de sueldo durante  un año por habérsele otorgado el beneficio del Año Sabático.";
        $motivo2->save();

        $motivo3 = new Motivo();
        $motivo3->numeroMotivo = 3;
        $motivo3->nombre = "EXTENSIÓN DE AÑO SABÁTICO";
        $motivo3->concepto = "Para dar de ALTA a los Suplentes del personal académico que disfruta de Licencia con goce de sueldo al  término del año sabático, cuando las actividades desempeñadas durante el mismo se prolongan por más del año.";
        $motivo3->save();

        $motivo4 = new Motivo();
        $motivo4->numeroMotivo = 4;
        $motivo4->nombre = "DESCARGA ACADÉMICA TOTAL POR ESTUDIOS  DE POSGRADO";
        $motivo4->concepto = "Para dar de ALTA a los Suplentes del personal académico, que durante un tiempo definido deja de impartir  toda su carga académica, para dedicarse a estudios de Posgrado.";
        $motivo4->save();

        $motivo5 = new Motivo();
        $motivo5->numeroMotivo = 5;
        $motivo5->nombre = "DESCARGA ACADÉMICA PARCIAL POR ESTUDIOS  DE POSGRADO";
        $motivo5->concepto = "Para dar de ALTA a los Suplentes del personal académico, que durante un tiempo definido deja de impartir  parte de su carga académica, para dedicarse a estudios de Posgrado.";
        $motivo5->save();

        $motivo6 = new Motivo();
        $motivo6->numeroMotivo = 6;
        $motivo6->nombre = "DESCARGA ACADÉMICA TOTAL POR  FUNCIONES DIRECTIVAS";
        $motivo6->concepto = "Para dar de ALTA a los suplentes del personal académico, que es descargado en la totalidad de su carga  académica para desempeñar un puesto de funcionario, se utiliza únicamente cuando el empleado sigue cobrando  en su plaza de académico.";
        $motivo6->save();

        $motivo7 = new Motivo();
        $motivo7->numeroMotivo = 7;
        $motivo7->nombre = "DESCARGA ACADÉMICA PARCIAL POR  FUNCIONES DIRECTIVAS";
        $motivo7->concepto = "Para dar de ALTA a los suplentes del personal académico, que es descargado en parte de su carga académica  para desempeñar un puesto de funcionario, se utiliza únicamente cuando el empleado sigue cobrando en su  plaza de académico.";
        $motivo7->save();

        $motivo8 = new Motivo();
        $motivo8->numeroMotivo = 8;
        $motivo8->nombre = "DESCARGA ACADÉMICA TOTAL POR COMISIÓN  ACADÉMICA";
        $motivo8->concepto = "Para dar de ALTA a los suplentes del personal académico, que deja de impartir por un tiempo definido, toda su  carga académica, para dedicarse a actividades académicas relacionadas con el Modelo Educativo Integral y  Flexible.";
        $motivo8->save();

        $motivo9 = new Motivo();
        $motivo9->numeroMotivo = 9;
        $motivo9->nombre = "DESCARGA ACADÉMICA PARCIAL POR  COMISIÓN ACADÉMICA";
        $motivo9->concepto = "Para dar de ALTA a los Suplentes del personal académico, que deja de impartir por un tiempo definido, parte  de su carga académica, para dedicarse a actividades académicas relacionadas con el Modelo Educativo Integral  y Flexible.";
        $motivo9->save();

        $motivo10 = new Motivo();
        $motivo10->numeroMotivo = 10;
        $motivo10->nombre = "PERMISO EXTRAORDINARIO";
        $motivo10->concepto = "LICENCIA CON SUELDO.- Que se le concede al personal académico por periodos máximo de 2 días para  cumplir con cargos específicos como asistencia a toma de poseciones de funcionarios, eventos extraordinarios  promovidos por la rectoría, a maestros consejeros para asistir a los consejos universitarios, desfile del primero de  Mayo, en revisiones contractuales a los delegados sexenales de regiones foráneas, (solo se ocupa para  justificación de inasistencias, no se generan suplencias para estos motivos salvo en el caso de hospital escuela)  para la justificación de inasistencias requiere de la autorización del Director General de Recursos Humanos.";
        $motivo10->save();

        $motivo11 = new Motivo();
        $motivo11->numeroMotivo = 11;
        $motivo11->nombre = "DESCARGA ACADÉMICA TOTAL POR  COMISION INSTITUCIONAL";
        $motivo11->concepto = "Para dar de ALTA a los Suplentes del personal académico, que deja de impartir por un tiempo determinado,  toda su carga académica, para realizar en la propia Institución, actividades distintas a las de su nombramiento.  Se utiliza para los casos en que no existe plaza presupuestada para la función encomendada por ejemplo:  Encargados de clínicas o laboratorio.";
        $motivo11->save();

        $motivo12 = new Motivo();
        $motivo12->numeroMotivo = 12;
        $motivo12->nombre = "DESCARGA ACADEMICA PARCIAL POR  COMISION INSTITUCIONAL ACAD";
        $motivo12->concepto = "Para dar de ALTA a los Suplentes del personal académico de planta, que deja de impartir por un tiempo  determinado, parte de su carga académica, para realizar en la propia Institución, actividades distintas a las de su  nombramiento.";
        $motivo12->save();

        $motivo13 = new Motivo();
        $motivo13->numeroMotivo = 13;
        $motivo13->nombre = "DESCARGA ACADEMICA PARCIAL POR  COMISION INSTITUCIONAL ACAD";
        $motivo13->concepto = "Para dar de ALTA a los Suplentes del personal de planta, que deja de laborar por un tiempo determinado, toda  su carga de trabajo, para que de acuerdo al Convenio firmado con el FESAPAUV el 7 de noviembre de 1986, y  contrato colectivo del SETSUV, se dedique a actividades propias del sindicato.";
        $motivo13->save();

        $motivo14 = new Motivo();
        $motivo14->numeroMotivo = 14;
        $motivo14->nombre = "LICENCIAS CON GOCE DE SUELDO POR  COMISION SINDICAL TOTAL";
        $motivo14->concepto = "Para dar de ALTA a los Suplentes del personal de planta, que deja de laborar por un tiempo determinado, hasta  por medio tiempo de su carga de trabajo, para que de acuerdo al Convenio firmado con el FESAPAUV el 7 de  noviembre de 1986, y contrato colectivo del SETSUV se dedique a actividades propias del sindicato.";
        $motivo14->save();

        $motivo15 = new Motivo();
        $motivo15->numeroMotivo = 15;
        $motivo15->nombre = "INCAPACIDAD MÉDICA";
        $motivo15->concepto = "Para dar de ALTA a los suplentes del personal académico ,confianza y administrativo, técnico y manual, que  deja de laborar su carga de trabajo, por el periodo que indique la constancia médica a los empleados que  padezcan alguna enfermedad, cualquiera que sea su naturaleza, siempre y cuando se justifique la necesidad y se  cuente con la autorización previa de la dirección general de recursos humanos para suplirlo.";
        $motivo15->save();

        $motivo16 = new Motivo();
        $motivo16->numeroMotivo = 16;
        $motivo16->nombre = "LICENCIA POR TITULACIÓN";
        $motivo16->concepto = "Para dar de ALTA a los Suplentes del personal académico, que deja de impartir su carga académica hasta por  30 días, por tener licencia con goce de sueldo para titulación.";
        $motivo16->save();

        $motivo17 = new Motivo();
        $motivo17->numeroMotivo = 17;
        $motivo17->nombre = "PERMISO ECONÓMICO";
        $motivo17->concepto = "Para dar de ALTA a los suplentes del personal académico, confianza y administrativo, técnico y manual, por  tener permiso con goce de sueldo para faltar a sus labores, siempre y cuando se justifique la necesidad y se  cuente con la autorización previa de la dirección general de recursos humanos para suplirlo.";
        $motivo17->save();

        $motivo18 = new Motivo();
        $motivo18->numeroMotivo = 18;
        $motivo18->nombre = "ASISTENCIA A EVENTOS ACADÉMICOS";
        $motivo18->concepto = "Para dar de ALTA a los Suplentes del personal académico por licencia con goce de sueldo que se le otorga al  personal académico hasta por 10 días al año para asistir a eventos académicos, siempre y cuando se justifique la  necesidad y se cuente con la autorización previa de la Dirección General de Recursos Humanos para suplirlo.";
        $motivo18->save();

        $motivo19 = new Motivo();
        $motivo19->numeroMotivo = 19;
        $motivo19->nombre = "REPOSICIÓN DE VACACIONES POR INCAPACIDAD MÉDICA";
        $motivo19->concepto = "Para dar de ALTA a los Suplentes del personal académico, confianza y administrativo, técnico y manual, al  término de la incapacidad médica del trabajador que se encuentre incapacitado en cualquiera de los períodos  vacacionales oficiales.";
        $motivo19->save();

        $motivo20 = new Motivo();
        $motivo20->numeroMotivo = 20;
        $motivo20->nombre = "VACACIONES ADICIONALES";
        $motivo20->concepto = "Para dar de ALTA a los Suplentes, que cubren los días laborales adicionales de vacaciones que disfruta el  personal de Confianza y administrativo, técnico y manual, las cuales se conceden en razón de los años de  servicios, siempre y cuando se justifique la necesidad y se cuente con la autorización previa de la Dirección  General de Recursos Humanos para suplirlo.";
        $motivo20->save();

        $motivo21 = new Motivo();
        $motivo21->numeroMotivo = 21;
        $motivo21->nombre = "CAPACITACIÓN AL PERSONAL NO ACADÉMICO";
        $motivo21->concepto = "Para dar de ALTA a los Suplentes, que cubren los días laborales adicionales de vacaciones que disfruta el  personal de Confianza y administrativo, técnico y manual, las cuales se conceden en razón de los años de  servicios, siempre y cuando se justifique la necesidad y se cuente con la autorización previa de la Dirección  General de Recursos Humanos para suplirlo.";
        $motivo21->save();

        $motivo22 = new Motivo();
        $motivo22->numeroMotivo = 22;
        $motivo22->nombre = "VACACIONES NORMALES";
        $motivo22->concepto = "Para dar de ALTA a los Suplentes que cubren los períodos normales de vacaciones que se otorgan a los  trabajadores, que por las características especiales de ciertas dependencias, tienen que ser cubiertos, siempre y  cuando se justifique la necesidad y se cuente con la autorización previa de la Dirección General de Recursos  Humanos para suplirlo.";
        $motivo22->save();

        $motivo23 = new Motivo();
        $motivo23->numeroMotivo = 23;
        $motivo23->nombre = "DIAS FESTIVOS";
        $motivo23->concepto = "Para dar de ALTA a los Suplentes del personal en sus descansos de días festivos, que por necesidades especiales de las dependencias, tienen que ser cubiertos por suplentes o por los mismos titulares, siempre y cuando se  justifique la necesidad y se cuente con la autorización previa de la Dirección General de Recursos Humanos  para suplirlo.";
        $motivo23->save();

        $motivo24 = new Motivo();
        $motivo24->numeroMotivo = 24;
        $motivo24->nombre = "COMISIÓN ADMINISTRATIVA";
        $motivo24->concepto = "Para dar de ALTA a los Suplentes del personal de confianza, que por ausencia excepcional del trabajador de  confianza previa autorización de la autoridad competente para desempeñar temporalmente sus funciones en un  lugar diferente al de su adscripción, siempre y cuando se justifique la necesidad y se cuente con la autorización  previa de la Dirección General de Recursos Humanos para suplirlo.";
        $motivo24->save();

        $motivo25 = new Motivo();
        $motivo25->numeroMotivo = 25;
        $motivo25->nombre = "PRORROGA PARA TITULACIÓN";
        $motivo25->concepto = "Para dar de ALTA a los Suplentes del personal académico, que deja de impartir su carga académica hasta por  15 días más como prorroga a la licencia con sueldo para titulación en casos justificados, para que se titulen.";
        $motivo25->save();

        $motivo26 = new Motivo();
        $motivo26->numeroMotivo = 26;
        $motivo26->nombre = "PRACTICAS DE ESTUDIOS CLAUSULA 61.2 C.C.T. (S.E.T.S.U.V.)";
        $motivo26->concepto = "Licencia con goce de sueldo; la otorga la institución a los trabajadores del SETSUV que estudian en la UV  cuando tienen que efectuar viajes de prácticas escolares, por el tiempo que duren las prácticas.";
        $motivo26->save();

        $motivo27 = new Motivo();
        $motivo27->numeroMotivo = 27;
        $motivo27->nombre = "PENDIENTE DE REUBICAR POR DICTAMEN  MÉDICO";
        $motivo27->concepto = "Para dar de ALTA a los suplentes que por dictamen médico permite que el titular pueda ser reubicado a realizar  funciones diferentes.";
        $motivo27->save();

        











    }
}

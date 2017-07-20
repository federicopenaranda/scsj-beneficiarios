Ext.define('sisscsj.controller.asistenciaactividad.AsistenciaBeneficiario', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'asistenciaactividad.AsistenciaActividad',
        'asistenciaactividad.AsistenciaBeneficiario',
        'asistenciaactividad.AsistenciaPersonal'
    ],
    views: [
        'asistenciaactividad.BeneficiariosLista',
        'asistenciaactividad.PersonalLista',
        'asistenciaactividad.edit.AsistenciaForm',
        'asistenciaactividad.edit.Form',
        'asistenciaactividad.edit.Window',
        'asistenciaactividad.edit.tab.Asistencia',
        'asistenciaactividad.edit.tab.Beneficiarios',
        'asistenciaactividad.edit.tab.Personal'
    ],
    refs: [
        {
            ref: 'ActividadLista',
            selector: '[xtype=actividad.lista]'
        },
        {
            ref: 'AsistenciaWindow',
            selector: '[xtype=asistenciaactividad.edit.window]'
        },
        {
            ref: 'AsistenciaForm',
            selector: '[xtype=asistenciaactividad.edit.form]'
        },
        {
            ref: 'AsistenciaBeneficiariosLista',
            selector: '[xtype=asistenciaactividad.beneficiarioslista]'
        },
        {
            ref: 'AsistenciaPersonalLista',
            selector: '[xtype=asistenciaactividad.personallista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=actividad.lista] button#asistencia': {
                    //click: this.add
                },
                'grid[xtype=asistenciaactividad.beneficiarioslista]': {
                    beforerender: this.loadRecords
                },
                'grid[xtype=asistenciaactividad.personallista]': {
                    beforerender: this.loadRecords
                },
                'window[xtype=asistenciaactividad.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=asistenciaactividad.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    

    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getAsistenciaWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('asistenciaactividad.edit.window', {
                title: isNew ? 'Crear Asistencia' : 'Editar Asistencia'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    sincronizar: function() {
        var me = this,
            grid = me.getAsistenciaBeneficiariosLista(),
            store = grid.getStore();

        store.sync();
    }


});
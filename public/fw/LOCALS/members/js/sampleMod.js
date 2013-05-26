ivyMods.set_iEdit.sampleMod = function(){

    iEdit.add_bttsConf(
        {
            'ENTname':
            {
                moduleName: 'sampleModule',
                deleteBt: {status:false, methName: 'sampleModule->deleteMethName'},
                addBt:  {status:false, methName: 'sampleModule->addMethName', atrValue: 'add Category'},
                saveBt:  {methName: 'sampleModule->updateMethName'}
            },
            'SINGname':
            {
                // pentru mai multe despre setarea butoanelor in EDITmode see EDITmode.js -> var bttConf
            }
        });
};